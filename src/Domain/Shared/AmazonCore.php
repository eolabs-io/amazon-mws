<?php

namespace EolabsIo\AmazonMws\Domain\Shared;

use EolabsIo\AmazonMwsClient\Facades\AmazonMwsHttp;
use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMws\Domain\Shared\Contracts\BranchUrlResolver;
use EolabsIo\AmazonMws\Domain\Shared\Contracts\TypeAccessor;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\AccessDeniedException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InputStreamDisconnectedException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InternalErrorException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InvalidAccessKeyIdException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InvalidAddressException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InvalidParameterValueException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\QuotaExceededException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\RequestThrottledException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\SignatureDoesNotMatchException;
use EolabsIo\AmazonMws\Support\Concerns\GeneratesTime;
use EolabsIo\AmazonMws\Support\Concerns\HasStoreInteractions;
use EolabsIo\AmazonMws\Support\Concerns\NextTokenable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class AmazonCore implements BranchUrlResolver, TypeAccessor
{
    use GeneratesTime,
        HasStoreInteractions,
        NextTokenable;

    /** @var Illuminate\Support\Collection */
    private $parameters;

    /** @var Illuminate\Http\Client\Response */
    private $response;

    /** @var Illuminate\Support\Collection */
    private $results;


    public function __construct()
    {
        $this->clearParameters();
        $this->results = new Collection();
        $this->clearNextToken();
    }

    private function getType(): string
    {
        return Str::lower($this->getTypeAccessor());
    }

    public function getVersion(): string
    {
        $type = $this->getType();
        return config('amazon-mws.constants.amazon.version.'.$type);
    }

    abstract public function getAction(): string;

    public function beforeFetch()
    {
    }

    public function fetch()
    {
        $this->beforeFetch();

        $store = $this->getStore();
        $endpoint = $this->getBranchUrl();
        $parameters = $this->getRequestParameters();

        try {
            $response = AmazonMwsHttp::withStore($store)
                                     ->fetch($endpoint, $parameters)
                                     ->throw();

            return $this->processResponse($response);
        } catch (RequestException $requestException) {
            $this->handleException($requestException);
        }
    }

    public function handleException(RequestException $requestException)
    {
        $response = $requestException->response;
        $results = AmazonMwsResponseParser::fromString($response->body());
        $errorCode = data_get($results, 'Error.Code');

        switch ($errorCode) {
            case 'InputStreamDisconnected':
                throw new InputStreamDisconnectedException($response);
            case 'InvalidParameterValue':
                throw new InvalidParameterValueException($response);
            case 'AccessDenied':
                throw new AccessDeniedException($response);
            case 'InvalidAccessKeyId':
                throw new InvalidAccessKeyIdException($response);
            case 'SignatureDoesNotMatch':
                throw new SignatureDoesNotMatchException($response);
            case 'InvalidAddress':
                throw new InvalidAddressException($response);
            case 'InternalError':
                throw new InternalErrorException($response);
            case 'QuotaExceeded':
                throw new QuotaExceededException($response);
            case 'RequestThrottled':
                throw new RequestThrottledException($response);
            default:
                throw $requestException;
        }
    }

    public function processResponse(Response $response)
    {
        $this->response = $response;

        $results = $this->getResultsFromResponseParser($response);

        $this->parseResults($results);

        return $this->getResults();
    }

    public function getResultsFromResponseParser(Response $response): Collection
    {
        return AmazonMwsResponseParser::fromString($response->body());
    }

    public function parseResults(Collection $results)
    {
        $this->checkForToken($results);
        $this->mergeResults($results);
    }

    public function getResults()
    {
        return $this->results;
    }

    public function mergeResults(Collection $response)
    {
        // Remove redundant data
        $response = $response->reject(function ($item, $key) {
            return in_array($key, ['RequestId', 'NextToken']);
        });
        $store_id = $this->getStore()->id;

        $this->results = $response->merge(compact('store_id'));
    }

    public function getRequestParameters(): array
    {
        $this->resolveParameters();

        return $this->parameters->toArray();
    }

    //=================
    public function resolveParameters(): void
    {
        $this->clearParameters();
        $this->resolveRequiredParameters();

        ($this->hasNextToken())
                ? $this->resolveNextTokenParameters()
                : $this->resolveOptionalParameters();
    }

    public function clearParameters(): void
    {
        $this->parameters = new Collection();
    }

    public function resolveRequiredParameters(): void
    {
        $this->mergeParameters([$this->store->toParameters(),
                                $this->getActionParameter(),
                                $this->getVersionParameter(),
                                $this->getSignatureMethodParameter(),
                                $this->getTimeStampParameter()]);
    }

    abstract public function resolveOptionalParameters(): void;

    public function resolveNextTokenParameters(): void
    {
        $this->mergeParameters([$this->getNextTokenParameter()]);
    }

    public function mergeParameters(array $newParameters): self
    {
        $parameters = Arr::collapse($newParameters);
        $this->parameters = $this->parameters->merge($parameters);

        return $this;
    }

    //=================

    public function getActionParameter(): array
    {
        return ['Action' => $this->getAction()];
    }

    public function getTimeStampParameter(): array
    {
        return ['Timestamp' => $this->genTime()];
    }

    public function getSignatureMethodParameter(): array
    {
        return ['SignatureMethod' => 'HmacSHA256', 'SignatureVersion' => '2'];
    }

    public function getVersionParameter(): array
    {
        return ['Version' => $this->getVersion()];
    }
}

<?php

namespace EolabsIo\AmazonMws\Tests\Factories\Concerns;

use Illuminate\Support\Facades\Http;


trait HasAmazonMwsErrorResponses
{

    public function fakeInputStreamDisconnectedErrorResponse(): self
    {
        $file = __DIR__ . '/../../Stubs/Responses/ErrorResponseInputStreamDisconnected.xml';
        $errorResponse = file_get_contents($file);

        return $this->makeHttpFake($errorResponse, 400);
    }

    public function fakeInvalidParameterValueErrorResponse(): self
    {
        $file = __DIR__ . '/../../Stubs/Responses/ErrorResponseInvalidParameterValue.xml';
        $errorResponse = file_get_contents($file);

        return $this->makeHttpFake($errorResponse, 400);
    }

    public function fakeAccessDeniedErrorResponse(): self
    {
        $file = __DIR__ . '/../../Stubs/Responses/ErrorResponseAccessDenied.xml';
        $errorResponse = file_get_contents($file);

        return $this->makeHttpFake($errorResponse, 401);
    }

    public function fakeInvalidAccessKeyIdErrorResponse(): self
    {
        $file = __DIR__ . '/../../Stubs/Responses/ErrorResponseInvalidAccessKeyId.xml';
        $errorResponse = file_get_contents($file);

        return $this->makeHttpFake($errorResponse, 403);
    }

    public function fakeSignatureDoesNotMatchErrorResponse(): self
    {
        $file = __DIR__ . '/../../Stubs/Responses/ErrorResponseSignatureDoesNotMatch.xml';
        $errorResponse = file_get_contents($file);

        return $this->makeHttpFake($errorResponse, 403);
    }

    public function fakeInvalidAddressErrorResponse(): self
    {
        $file = __DIR__ . '/../../Stubs/Responses/ErrorResponseInvalidAddress.xml';
        $errorResponse = file_get_contents($file);

        return $this->makeHttpFake($errorResponse, 404);
    }

    public function fakeInternalErrorResponse(): self
    {
        $file = __DIR__ . '/../../Stubs/Responses/ErrorResponseInternalError.xml';
        $errorResponse = file_get_contents($file);

        return $this->makeHttpFake($errorResponse, 500);
    }

    public function fakeQuotaExceededErrorResponse(): self
    {
        $file = __DIR__ . '/../../Stubs/Responses/ErrorResponseQuotaExceeded.xml';
        $errorResponse = file_get_contents($file);

        $headers = ['x-mws-quota-max' => '1800',
                    'x-mws-quota-remaining' => '0',
                    'x-mws-quota-resetsOn' => 'Wed, 06 Mar 2013 19:07:58 GMT',];

        return $this->makeHttpFake($errorResponse, 503, $headers);
    }

    public function fakeRequestThrottledErrorResponse(): self
    {
        $file = __DIR__ . '/../../Stubs/Responses/ErrorResponseRequestThrottled.xml';
        $errorResponse = file_get_contents($file);

        return $this->makeHttpFake($errorResponse, 503);
    }

    private function makeHttpFake($response, $status, $headers = []): self
    {
        Http::fake([
             '*' => Http::sequence()
                        ->push($response, $status, $headers),
        ]);

        return $this;    
    }
}
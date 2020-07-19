<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Concerns;

use EolabsIo\AmazonMws\Domain\Shared\Exceptions\QuotaExceededException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\RequestThrottledException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Carbon;


trait HandlesJobsRequestException
{

	public function handleRequestException(RequestException $exception, int $delay = 3)
	{

        switch(true) {
            case ($exception instanceOf QuotaExceededException):
                return $this->handleQuotaExceededException($exception);
            case ($exception instanceOf RequestThrottledException):
                return $this->release($delay);
            default:
                $this->fail($exception);
        }
	}

    protected function handleQuotaExceededException(QuotaExceededException $requestException)
    {
        $response = $requestException->response;
        $resetsOn = $response->header('x-mws-quota-resetsOn');
        
        $secondsUntilReset = Carbon::now()->diffInSeconds($resetsOn);

        if($secondsUntilReset > 0) {
            $this->release($secondsUntilReset);
        }
    }
}
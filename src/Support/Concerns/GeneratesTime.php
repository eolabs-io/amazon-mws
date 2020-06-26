<?php

namespace EolabsIo\AmazonMws\Support\Concerns;

use Illuminate\Support\Carbon;

trait GeneratesTime
{
    /**
     * Generates timestamp in ISO8601 format.
     *
     * @return string Unix timestamp of the time.
     */
    protected function genTime(Carbon $dateTime = null): string 
    {
    	$time = $dateTime ?? Carbon::now();

        return $time->toIso8601ZuluString();
    }
}
<?php

namespace EolabsIo\AmazonMws\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see EolabsIo\AmazonMws\Domain\Reports\RequestReport
 */
class CancelReportRequests extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cancel-report-requests';
    }
}

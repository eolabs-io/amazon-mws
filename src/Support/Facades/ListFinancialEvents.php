<?php

namespace EolabsIo\AmazonMws\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see EolabsIo\AmazonMws\Domain\Finance\ListFinancialEventGroups
 */
class ListFinancialEvents extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'list-financial-events';
    }
}
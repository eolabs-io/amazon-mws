<?php

namespace EolabsIo\AmazonMws\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see EolabsIo\AmazonMws\Domain\Orders\ListOrders
 */
class ListOrders extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'list-orders';
    }
}
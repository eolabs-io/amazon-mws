<?php

namespace EolabsIo\AmazonMws\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see EolabsIo\AmazonMws\Domain\Inventory\InventoryList
 */
class GetProductCategoriesForSku extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'get-product-categories-for-sku';
    }
}

<?php

namespace EolabsIo\AmazonMws\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see EolabsIo\AmazonMws\Domain\Products\GetProductCategoriesForAsin
 */
class GetProductCategoriesForAsin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'get-product-categories-for-asin';
    }
}

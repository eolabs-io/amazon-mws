<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Support\Facades\GetProductCategoriesForSku;
use EolabsIo\AmazonMws\Tests\Factories\GetProductCategoriesForSkuFactory;

trait CreatesGetProductCategoriesForSku
{
    public function createGetProductCategoriesForSku()
    {
        GetProductCategoriesForSkuFactory::new()->fakeResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return GetProductCategoriesForSku::withStore($store);
    }
}

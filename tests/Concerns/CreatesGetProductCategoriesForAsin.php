<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Support\Facades\GetProductCategoriesForAsin;
use EolabsIo\AmazonMws\Tests\Factories\GetProductCategoriesForAsinFactory;

trait CreatesGetProductCategoriesForAsin
{
    public function createGetProductCategoriesForAsin()
    {
        GetProductCategoriesForAsinFactory::new()->fakeResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return GetProductCategoriesForAsin::withStore($store);
    }
}

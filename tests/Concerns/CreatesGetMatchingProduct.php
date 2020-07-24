<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Support\Facades\GetMatchingProduct;
use EolabsIo\AmazonMws\Tests\Factories\GetMatchingProductFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;


trait CreatesGetMatchingProduct
{

    public function createGetMatchingProduct()
    {
        GetMatchingProductFactory::new()->fakeGetMatchingProductResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return GetMatchingProduct::withStore($store);    
    }

}
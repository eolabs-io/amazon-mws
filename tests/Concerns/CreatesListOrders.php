<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Support\Facades\ListOrders;
use EolabsIo\AmazonMws\Tests\Factories\ListOrdersFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;


trait CreatesListOrders
{

    public function createListOrders()
    {
        ListOrdersFactory::new()->fakeFulfillmentListOrdersResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return ListOrders::withStore($store);    
    }

    public function createListOrdersWithToken()
    {
        ListOrdersFactory::new()->fakeFulfillmentListOrdersTokenResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return ListOrders::withStore($store);    
    }
}
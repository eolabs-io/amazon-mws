<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Support\Facades\ListOrderItems;
use EolabsIo\AmazonMws\Tests\Factories\ListOrderItemsFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;


trait CreatesListOrderItems
{

    public function createListOrderItems()
    {
        ListOrderItemsFactory::new()->fakeListOrderItemsResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return ListOrderItems::withStore($store);    
    }

    public function createListOrderItemsWithToken()
    {
        ListOrderItemsFactory::new()->fakeListOrderItemsTokenResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return ListOrderItems::withStore($store);    
    }
}
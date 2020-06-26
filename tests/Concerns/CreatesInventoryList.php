<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Support\Facades\InventoryList;
use EolabsIo\AmazonMws\Tests\Factories\InventoryFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;


trait CreatesInventoryList
{

    public function createInventoryList()
    {
        InventoryFactory::new()->fakeFulfillmentInventoryResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return InventoryList::withStore($store);    
    }

    public function createInventoryListWithToken()
    {
        InventoryFactory::new()->fakeFulfillmentInventoryTokenResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return InventoryList::withStore($store);    
    }
}
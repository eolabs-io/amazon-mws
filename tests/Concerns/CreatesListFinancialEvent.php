<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Support\Facades\ListFinancialEvents;
use EolabsIo\AmazonMws\Tests\Factories\ListFinancialEventsFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;


trait CreatesListFinancialEvent
{

    public function createListFinancialEvent()
    {
        ListFinancialEventsFactory::new()->fakeListFinancialEventsResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return ListFinancialEvents::withStore($store);    
    }

    public function createListFinancialEventWithToken()
    {
        ListFinancialEventsFactory::new()->fakeListFinancialEventsTokenResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return ListFinancialEvents::withStore($store);    
    }
}
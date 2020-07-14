<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Support\Facades\ListFinancialEventGroups;
use EolabsIo\AmazonMws\Tests\Factories\ListFinancialEventGroupsFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;


trait CreatesListFinancialEventGroup
{

    public function createListFinancialEventGroup()
    {
        ListFinancialEventGroupsFactory::new()->fakeListFinancialEventGroupsResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return ListFinancialEventGroups::withStore($store);    
    }

    public function createListFinancialEventGroupWithToken()
    {
        ListFinancialEventGroupsFactory::new()->fakeListFinancialEventGroupsTokenResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return ListFinancialEventGroups::withStore($store);    
    }
}
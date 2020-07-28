<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Support\Facades\ListMarketplaceParticipations;
use EolabsIo\AmazonMws\Tests\Factories\ListMarketplaceParticipationsFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;


trait CreatesListMarketplaceParticipations
{

    public function createListMarketplaceParticipations()
    {
        ListMarketplaceParticipationsFactory::new()->fakeListMarketplaceParticipationsResponse();

        $store = StoreFactory::new()
                             ->withValidAttributes()
                             ->create();

        return ListMarketplaceParticipations::withStore($store);    
    }

}
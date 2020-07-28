<?php

namespace EolabsIo\AmazonMws\Domain\Sellers\Listeners;

use EolabsIo\AmazonMws\Domain\Sellers\Events\FetchListMarketplaceParticipations;
use EolabsIo\AmazonMws\Domain\Sellers\Jobs\PerformFetchListMarketplaceParticipations;


class FetchListMarketplaceParticipationsListener
{
    public function handle(FetchListMarketplaceParticipations $event)
    {
    	$listMarketplaceParticipations = $event->listMarketplaceParticipations;
    	PerformFetchListMarketplaceParticipations::dispatch($listMarketplaceParticipations)
    											 ->onQueue('list-marketplace-participations');
    }
}
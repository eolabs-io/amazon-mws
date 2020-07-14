<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Listeners;

use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEventGroups;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\PerformFetchListFinancialEventGroups;

class FetchListFinancialEventGroupsListener
{
    public function handle(FetchListFinancialEventGroups $event)
    {
    	$fetchListFinancialEventGroups = $event->fetchListFinancialEventGroups;
    	PerformFetchListFinancialEventGroups::dispatch($fetchListFinancialEventGroups)->onQueue('list-financial-event-groups');
    }
}
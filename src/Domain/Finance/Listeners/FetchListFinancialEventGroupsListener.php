<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Listeners;

use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEventGroups;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\PerformFetchListFinancialEventGroups;

class FetchListFinancialEventGroupsListener
{
    public function handle(FetchListFinancialEventGroups $event)
    {
    	$listFinancialEventGroups = $event->listFinancialEventGroups;
    	PerformFetchListFinancialEventGroups::dispatch($listFinancialEventGroups)->onQueue('list-financial-event-groups');
    }
}
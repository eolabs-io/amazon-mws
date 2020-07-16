<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Listeners;

use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\PerformFetchListFinancialEvents;

class FetchListFinancialEventsListener
{
    public function handle(FetchListFinancialEvents $event)
    {
    	$listFinancialEvents = $event->listFinancialEvents;
    	PerformFetchListFinancialEvents::dispatch($listFinancialEvents)->onQueue('list-financial-events');
    }
}
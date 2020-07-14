<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Listeners;

use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\PerformFetchListFinancialEvents;

class FetchListFinancialEventsListener
{
    public function handle(FetchListFinancialEvents $event)
    {
    	$fetchListFinancialEvents = $event->fetchListFinancialEvents;
    	PerformFetchListFinancialEvents::dispatch($fetchListFinancialEvents)->onQueue('list-financial-events');
    }
}
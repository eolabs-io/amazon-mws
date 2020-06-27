<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrders;
use EolabsIo\AmazonMws\Support\Facades\ListOrders;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class Orders extends Command
{
    protected $signature = 'amazonmws:orders
                            {store : The ID of the store}
                            {--last-updated-after= : A date used for selecting orders that were last updated after (or at) a specified time}
                            {--last-updated-before= : A date used for selecting orders that were last updated before (or at) a specified time}
                            {--created-after= : A date used for selecting orders created after (or at) a specified time.}
                            {--created-before= : A date used for selecting orders created before (or at) a specified time.}';

    protected $description = 'Gets Orders from Amazon MWS';


    public function handle()
    {
        $this->info('Geting Orders from Amazon MWS...');

        $store = Store::find($this->argument('store'));
        $lastUpdatedAfter = $this->option('last-updated-after');
        $lastUpdatedBefore = $this->option('last-updated-before');
        $createdAfter = $this->option('created-after');
        $createdBefore = $this->option('created-before'); 

        $listOrders = ListOrders::withStore($store);  

        if($lastUpdatedAfter) {
            $listOrders->withLastUpdatedAfter(Carbon::create($lastUpdatedAfter));
        }

        if($lastUpdatedBefore) {
            $listOrders->withLastUpdatedBefore(Carbon::create($lastUpdatedBefore));
        }

        if($createdAfter) {
            $listOrders->withCreatedAfter(Carbon::create($createdAfter));
        }

        if($createdBefore) {
            $listOrders->withCreatedBefore(Carbon::create($createdBefore));
        }

        FetchListOrders::dispatch($listOrders);
    }
}
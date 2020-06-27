<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrders;
use EolabsIo\AmazonMws\Support\Facades\ListOrders;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GetOrders extends Command
{
    protected $signature = 'amazonmws:orders
                            {store : The ID of the store}
                            {--last-updated-after : A date used for selecting orders that were last updated after (or at) a specified time}';

    protected $description = 'Gets Orders from Amazon MWS';


    public function handle()
    {
        $this->info('Geting Orders from Amazon MWS...');

        $store = Store::find($this->argument('store'));
        $lastUpdatedAfter = Carbon::create($this->option('last-updated-after'));
        
        $inventoryList = ListOrders::withStore($store)->withLastUpdatedAfter($lastUpdatedAfter);  
        FetchListOrders::dispatch($inventoryList);
    }
}
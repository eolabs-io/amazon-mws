<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrders;
use EolabsIo\AmazonMws\Support\Facades\ListOrders;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GetOrders extends Command
{
    protected $signature = 'amazonmws:get-orders';

    protected $description = 'Gets Orders from Amazon MWS';

    public function handle()
    {
        $this->info('Geting Orders from Amazon MWS...');

        foreach (Store::all() as $store) {
            $inventoryList = ListOrders::withStore($store)->withLastUpdatedAfter(Carbon::now()->subDays(30));  
            FetchListOrders::dispatch($inventoryList);
        }
    }
}
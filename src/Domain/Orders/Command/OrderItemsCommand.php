<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrderItems;
use EolabsIo\AmazonMws\Support\Facades\ListOrderItems;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class OrderItemsCommand extends Command
{
    protected $signature = 'amazonmws:order-items
                            {store : The ID of the store}
                            {--amazon-order-id= : The Amazon Order Id for the items}';

    protected $description = 'Gets Order Items from Amazon MWS';


    public function handle()
    {
        $this->info('Getting Order items from Amazon MWS...');

        $store = Store::find($this->argument('store'));
        $amazonOrderId = $this->option('amazon-order-id');

        $listOrderItems = ListOrderItems::withStore($store);  

        if($amazonOrderId) {
            $listOrderItems->withAmazonOrderId($amazonOrderId);
        }

        FetchListOrderItems::dispatch($listOrderItems);
    }
}
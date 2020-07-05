<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Support\Facades\ListOrderItems;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class OrderItemsCommand extends Command
{
    protected $signature = 'amazonmws:order-items
                            {store : The ID of the store}
                            {--amazon-order-id= : The Amazon Order Id for the items}
                            {--discover : Find Orders without OrderItems are try to import them}';

    protected $description = 'Gets Order Items from Amazon MWS';


    public function handle()
    {
        $this->info('Getting Order items from Amazon MWS...');

        $store = Store::find($this->argument('store'));
        $listOrderItems = ListOrderItems::withStore($store);  
        $discover = $this->option('discover');
        $amazonOrderId = $this->option('amazon-order-id');

        if($discover) {
            Order::whereNotIn('amazon_order_id', 
                                OrderItem::select('amazon_order_id')->get())
                   ->select('amazon_order_id')
                   ->get()
                   ->each(function($item) use ($listOrderItems) {
                        $amazonOrderId = $item['amazon_order_id'];
                        $listOrderItems->withAmazonOrderId($amazonOrderId);
                        FetchListOrderItems::dispatch($listOrderItems);
                   });

        } 

        if($amazonOrderId) {
            $listOrderItems->withAmazonOrderId($amazonOrderId);
            FetchListOrderItems::dispatch($listOrderItems);
        }
    }


}
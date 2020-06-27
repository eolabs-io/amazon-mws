<?php

namespace EolabsIo\AmazonMws\Domain\Inventory\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Inventory\Events\FetchInventoryList;
use EolabsIo\AmazonMws\Support\Facades\InventoryList;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class Inventory extends Command
{
    protected $signature = 'amazonmws:inventory
                            {store : The ID of the store}
                            {--seller-skus=* : A list of seller SKUs for items that you want inventory availability information about.}
                            {--query-start-date-time= : A date used for selecting items that have had changes in inventory availability after (or at) a specified time.}
                            {--detailed-response-group : Indicates whether or not you want the operation to return the SupplyDetail element.}';

    protected $description = 'Gets Inventory from Amazon MWS';


    public function handle()
    {
        $this->info('Geting Inventory from Amazon MWS...');

        $store = Store::find($this->argument('store'));
        $sellerSkus = $this->option('seller-skus');
        $queryStartDateTime = $this->option('query-start-date-time');
        $detailedResponseGroup = $this->option('detailed-response-group');
        
        $inventoryList = InventoryList::withStore($store);

        if($sellerSkus) {
            $inventoryList->withSellerSkus($sellerSkus);
        }

        if($queryStartDateTime) {
            $inventoryList->withQueryStartDateTime( Carbon::create($queryStartDateTime) );   
        }

        if($detailedResponseGroup) {
            $inventoryList->withDetailedResponseGroup();   
        }
 
        FetchInventoryList::dispatch($inventoryList);
    }
}
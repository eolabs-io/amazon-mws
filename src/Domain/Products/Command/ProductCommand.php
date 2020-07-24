<?php

namespace EolabsIo\AmazonMws\Domain\Products\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetMatchingProduct;
use EolabsIo\AmazonMws\Support\Facades\GetMatchingProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ProductCommand extends Command
{
    protected $signature = 'amazonmws:product
                            {store : The ID of the store}
                            {--marketplace-id= : A marketplace identifier. Specifies the marketplace from which products are returned. }
                            {--asin=* : A structured list of ASIN values. Used to identify products in the given marketplace.}';

    protected $description = 'Gets Inventory from Amazon MWS';


    public function handle()
    {
        $this->info('Getting Products from Amazon MWS...');

        $store = Store::find($this->argument('store'));
        $marketplaceId = $this->option('marketplace-id');
        $asins = $this->option('asin');

        if(blank($marketplaceId) || (count($asins) == 0)) {
            return $this->info('MarketplaceId and at least one ASIN is required');
        }
        
        $getMatchingProduct = GetMatchingProduct::withStore($store);

        if($marketplaceId) {
            $getMatchingProduct->withMarketplaceId($marketplaceId);
        }

        if($asins) {
            $getMatchingProduct->withAsins($asins);   
        }

        FetchGetMatchingProduct::dispatch($getMatchingProduct);
    }
}
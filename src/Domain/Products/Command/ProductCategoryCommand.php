<?php

namespace EolabsIo\AmazonMws\Domain\Products\Command;

use Illuminate\Console\Command;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Support\Facades\GetProductCategoriesForSku;
use EolabsIo\AmazonMws\Support\Facades\GetProductCategoriesForAsin;
use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetProductCategoriesForSku;
use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetProductCategoriesForAsin;

class ProductCategoryCommand extends Command
{
    protected $signature = 'amazonmws:product-category
                            {store : The ID of the store}
                            {--marketplace-id= : A marketplace identifier. Specifies the marketplace from which products are returned.}
                            {--asin= : Used to identify products in the given marketplace.}
                            {--sku= : Used to identify products in the given marketplace.}';

    protected $description = 'Gets Product Categories from Amazon MWS';


    public function handle()
    {
        $this->info('Getting Product Categories from Amazon MWS...');

        $store = Store::find($this->argument('store'));
        $marketplaceId = $this->option('marketplace-id');
        $asin = $this->option('asin');
        $sku = $this->option('sku');

        if (blank($marketplaceId) || !(filled($sku) xor filled($asin))) {
            return $this->info('MarketplaceId and ASIN or SKU is required');
        }

        if ($asin) {
            $getProductCategoriesForAsin = GetProductCategoriesForAsin::withStore($store)
                ->withMarketplaceId($marketplaceId)
                ->withAsin($asin);

            FetchGetProductCategoriesForAsin::dispatch($getProductCategoriesForAsin);
        } elseif ($sku) {
            $getProductCategoriesForSku = GetProductCategoriesForSku::withStore($store)
                ->withMarketplaceId($marketplaceId)
                ->withSku($sku);

            FetchGetProductCategoriesForSku::dispatch($getProductCategoriesForSku);
        }
    }
}

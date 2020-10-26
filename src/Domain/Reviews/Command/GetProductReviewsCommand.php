<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Command;

use Illuminate\Console\Command;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Reviews\GetProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetProductReview;

class GetProductReviewsCommand extends Command
{
    protected $signature = 'amazonmws:get-product-reviews
                            {--asins=* : A list of asins to log}
                            {--marketplace-ids=* : A list of marketplaces to log. Uses Products table}';

    protected $description = 'Gets Product Reviews from Amazon';


    public function handle()
    {
        $this->info('Getting Product Reviews from Amazon...');
        $asins = collect($this->option('asins'));
        $marketplaceIds = collect($this->option('marketplace-ids'));

        $marketplaceIds->each(function ($marketplaceId) use ($asins) {
            Product::where('marketplace_id', $marketplaceId)
                ->pluck('asin')
                ->each(function ($asin) use ($asins) {
                    $asins->add($asin);
                });
        });

        $asins->each(function ($asin) {
            $getProductReview =  (new GetProductReview)->withAsin($asin);
            FetchGetProductReview::dispatch($getProductReview);
        });
    }
}

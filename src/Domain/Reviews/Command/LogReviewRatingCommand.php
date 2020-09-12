<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Command;

use Illuminate\Console\Command;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating;
use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetReviewRating;

class LogReviewRatingCommand extends Command
{
    protected $signature = 'amazonmws:log-review-ratings
                            {--asins=* : A list of asins to log}
                            {--marketplace-ids=* : A list of marketplaces to log. Uses Products table}';

    protected $description = 'Gets Orders from Amazon MWS';


    public function handle()
    {
        $this->info('Getting Review Ratings from Amazon...');
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
            $getReviewRating =  (new GetReviewRating)->withAsin($asin);
            FetchGetReviewRating::dispatch($getReviewRating);
        });
    }
}

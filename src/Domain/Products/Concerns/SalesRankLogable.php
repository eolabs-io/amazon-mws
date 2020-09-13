<?php

namespace EolabsIo\AmazonMws\Domain\Products\Concerns;

use EolabsIo\AmazonMws\Domain\Products\Models\SalesRankHistory;

trait SalesRankLogable
{
    public $isLogable = true;

    public static function bootSalesRankLogable()
    {
        static::created(function ($salesRank) {
            if (!$salesRank->isLogable) {
                return;
            }
            $salesRank->load('product');
            SalesRankHistory::create([
                'asin' => $salesRank->product->asin,
                'product_category_id' => $salesRank->product_category_id,
                'rank' => $salesRank->rank,
            ]);
        });

        static::updated(function ($salesRank) {
            if (!$salesRank->isLogable) {
                return;
            }
            $salesRank->load('product');
            SalesRankHistory::create([
                'asin' => $salesRank->product->asin,
                'product_category_id' => $salesRank->product_category_id,
                'rank' => $salesRank->rank,
            ]);
        });
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Database\Factories\SalesRankFactory;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Products\Concerns\SalesRankLogable;

class SalesRank extends AmazonMwsModel
{
    use SalesRankLogable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'product_id',
                            'product_category_id',
                            'rank',
                        ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return SalesRankFactory::new();
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Products\Concerns\SalesRankLogable;

class SalesRank extends Model
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
}

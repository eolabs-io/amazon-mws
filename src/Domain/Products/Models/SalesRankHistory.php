<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use Illuminate\Database\Eloquent\Model;

class SalesRankHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'asin',
                            'product_category_id',
                            'rank',
                        ];
}

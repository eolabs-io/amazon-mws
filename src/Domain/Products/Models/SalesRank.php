<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Model;


class SalesRank extends Model
{
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
<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Model;


class VariationChild extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    						'product_id',
							'color', 
							'size', 
    					];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

}
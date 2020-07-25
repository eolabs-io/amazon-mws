<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use EolabsIo\AmazonMws\Domain\Products\Models\Feature;
use EolabsIo\AmazonMws\Domain\Products\Models\Image;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemDimension;
use EolabsIo\AmazonMws\Domain\Products\Models\PackageDimension;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Model;


class ItemAttributes extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_adult_product' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    						'binding',
    						'brand',
    						'is_adult_product',
    						'label',
    						'manufacturer',
    						'package_quantity',
    						'part_number',
    						'product_group',
    						'product_type_name',
    						'publisher',
    						'size',
    						'studio',
    						'title',
    						'item_dimension_id',
    						'package_dimension_id',
    						'small_image_id',
                            'product_id',
    					];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

	public function itemDimension()
	{
		return $this->belongsTo(ItemDimension::class);
	}

	public function packageDimension()
	{	
		return $this->belongsTo(PackageDimension::class);	
	}

	public function smallImage()
	{
		return $this->belongsTo(Image::class);
	}

    public function features()
    {
        return $this->hasMany(Feature::class, 'item_attribute_id');
    }

}

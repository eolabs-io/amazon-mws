<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\ProductCategoryFactory;

class ProductCategory extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'product_category_id',
                            'product_category_name',
                            'parent_id',
                        ];

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id', 'product_category_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ProductCategoryFactory::new();
    }
}

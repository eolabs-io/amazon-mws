<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
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
}

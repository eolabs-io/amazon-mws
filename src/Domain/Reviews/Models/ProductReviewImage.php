<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Models;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\ProductReviewImageFactory;

class ProductReviewImage extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'product_review_id',
                            'url',
                        ];

    public function productReview()
    {
        return $this->belongsTo(ProductReview::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ProductReviewImageFactory::new();
    }
}

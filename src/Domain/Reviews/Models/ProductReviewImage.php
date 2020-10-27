<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Models;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;

class ProductReviewImage extends Model
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
}

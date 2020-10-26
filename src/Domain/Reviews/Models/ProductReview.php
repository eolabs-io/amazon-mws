<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'verifiedPurchase' => 'boolean',
        'earlyReviewerRewards' => 'boolean',
        'vineVoice' => 'boolean',
        'date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'asin',
                            'reviewId',
                            'profileName',
                            'starRating',
                            'title',
                            'date',
                            'verifiedPurchase',
                            'earlyReviewerRewards',
                            'vineVoice',
                            'body',
                        ];
}

<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Models;

use Illuminate\Support\Carbon;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\ProductReviewFactory;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewImage;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewStatus;
use EolabsIo\AmazonMws\Domain\Reviews\Events\ProductReviewWasCreated;

class ProductReview extends AmazonMwsModel
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ProductReviewWasCreated::class,
    ];

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

    protected $appends = ['date_for_editing'];

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
                            'product_review_status_id',
                        ];

    public function images()
    {
        return $this->hasMany(ProductReviewImage::class);
    }

    public function status()
    {
        return $this->belongsTo(ProductReviewStatus::class, 'product_review_status_id');
    }

    public function getDateForHumansAttribute()
    {
        return $this->date->format('M d, Y');
    }

    public function getDateForEditingAttribute()
    {
        return $this->date->format('m/d/Y');
    }

    public function setDateForEditingAttribute($value)
    {
        $this->date = Carbon::parse($value);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ProductReviewFactory::new();
    }
}

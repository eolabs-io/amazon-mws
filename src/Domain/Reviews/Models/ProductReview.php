<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewImage;

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
                        ];

    public function images()
    {
        return $this->hasMany(ProductReviewImage::class);
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
}

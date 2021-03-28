<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\ImagingServicesFeeEventFactory;

class ImagingServicesFeeEvent extends AmazonMwsModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'posted_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'imaging_request_billing_item_id',
                    'asin',
                    'posted_date',
                ];

    public function feeList()
    {
        return $this->belongsToMany(FeeComponent::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ImagingServicesFeeEventFactory::new();
    }
}

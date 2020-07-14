<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use Illuminate\Database\Eloquent\Model;


class ImagingServicesFeeEvent extends Model
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
	
}
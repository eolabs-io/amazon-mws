<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use Illuminate\Database\Eloquent\Model;


class PayWithAmazonEvent extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'transaction_posted_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'seller_order_id',
                    'transaction_posted_date',
                    'business_object_type',
                    'sales_channel',
                    'charge_id',
                    'payment_amount_type',
                    'amount_description',
                    'fulfillment_channel',
                    'store_name',
				];

	public function charge()
	{
		return $this->belongsTo(ChargeComponent::class);
	}


    public function feeList()
    {
        return $this->belongsToMany(FeeComponent::class, 'fee_component_fee_list');
    }

}
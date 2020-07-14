<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use Illuminate\Database\Eloquent\Model;


class CouponPaymentEvent extends Model
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
                    'posted_date',
                    'coupon_id',
                    'seller_coupon_description',
                    'clip_or_redemption_count',
                    'payment_event_id',
                    'fee_component_id',
                    'charge_component_id',
                    'total_amount_id',
				];

	public function feeComponent()
	{
		return $this->belongsTo(FeeComponent::class, 'fee_component_id', 'id')->withDefault();
	}

    public function chargeComponent()
    {
        return $this->belongsTo(ChargeComponent::class, 'charge_component_id', 'id')->withDefault();
    }

    public function totalAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'total_amount_id', 'id')->withDefault();
    }

}
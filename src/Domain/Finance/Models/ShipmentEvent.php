<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\DirectPayment;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentItem;
use Illuminate\Database\Eloquent\Model;


class ShipmentEvent extends Model
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
                    'amazon_order_id',
                    'seller_order_id',
                    'marketplace_name',
                    'posted_date',
				];

	public function orderChargeList()
	{
        return $this->morphToMany(ChargeComponent::class, 'charge_componentable', 'order_chargables');
	}

    public function orderChargeAdjustmentList()
    {
        return $this->morphToMany(ChargeComponent::class, 'charge_componentable', 'order_charge_adjustmentables');
    }

    public function shipmentFeeList()
    {     
        return $this->morphToMany(FeeComponent::class, 'fee_componentable', 'shipment_feeables');
    }

    public function shipmentFeeAdjustmentList()
    {
        return $this->morphToMany(FeeComponent::class, 'fee_componentable', 'shipment_fee_adjustmentables');
    } 

    public function orderFeeList()
    {
        return $this->morphToMany(FeeComponent::class, 'fee_componentable', 'order_feeables');
    }

    public function orderFeeAdjustmentList()
    {
        return $this->morphToMany(FeeComponent::class, 'fee_componentable', 'order_fee_adjustmentables');
    }

    public function directPaymentList()
    {
        return $this->morphToMany(DirectPayment::class, 'direct_paymentable');
    }

    public function shipmentItemList()
    {
        return $this->morphToMany(ShipmentItem::class, 'shipment_itemable');
    }

    public function shipmentItemAdjustmentList()
    {
        return $this->morphToMany(ShipmentItem::class, 'shipment_itemable', 'shipment_item_adjustmentables');
    }
}
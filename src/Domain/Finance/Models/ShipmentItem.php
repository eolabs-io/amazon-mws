<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\Promotion;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;
use Illuminate\Database\Eloquent\Model;


class ShipmentItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'seller_sku',
                    'order_item_id',
                    'order_adjustment_item_id',
                    'quantity_shipped',
                    'cost_of_points_granted_id',
                    'cost_of_points_returned_id',
				];

    protected $hidden = ['pivot'];

	public function itemChargeList()
	{
		return $this->belongsToMany(ChargeComponent::class, 'charge_component_item_charge');
	}

    public function itemTaxWithheldList()
    {
        return $this->belongsToMany(TaxWithheldComponent::class, 'item_tax_withheld_tax_withheld_component');
    }

    public function itemChargeAdjustmentList()
    {
        return $this->belongsToMany(ChargeComponent::class, 'charge_component_item_charge_adjustment');
    }

    public function itemFeeList()
    {
        return $this->belongsToMany(FeeComponent::class, 'fee_component_item_fee');
    }

    public function itemFeeAdjustmentList()
    {
        return $this->belongsToMany(FeeComponent::class, 'fee_component_item_fee_adjustment');
    } 

    public function promotionList()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_promotion_list');
    } 

    public function promotionAdjustmentList()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_promotion_adjustment_list');
    } 

    public function costOfPointsGranted()
    {
        return $this->belongsTo(CurrencyAmount::class, 'cost_of_points_granted_id', 'id')->withDefault();
    }

    public function costOfPointsReturned()
    {
        return $this->belongsTo(CurrencyAmount::class, 'cost_of_points_returned_id', 'id')->withDefault();
    }
}
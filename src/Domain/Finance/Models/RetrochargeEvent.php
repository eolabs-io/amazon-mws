<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;
use Illuminate\Database\Eloquent\Model;


class RetrochargeEvent extends Model
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
                    'retrocharge_event_type',
                    'amazon_order_id',
                    'posted_date',
                    'base_tax_id',
                    'shipping_tax_id',
                    'marketplace_name',
				];
    
    protected $hidden = ['pivot'];

	public function baseTax()
	{
		return $this->belongsTo(CurrencyAmount::class, 'base_tax_id', 'id')->withDefault();
	}

    public function shippingTax()
    {
        return $this->belongsTo(CurrencyAmount::class, 'shipping_tax_id', 'id')->withDefault();
    }

    public function retrochargeTaxWithheldComponentList()
    {
        return $this->belongsToMany(TaxWithheldComponent::class, 'retrocharge_tax_withheld_component_tax_withheld_component');
    }

}
<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Database\Factories\RetrochargeEventFactory;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;

class RetrochargeEvent extends AmazonMwsModel
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return RetrochargeEventFactory::new();
    }
}

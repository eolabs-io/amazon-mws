<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Database\Factories\PayWithAmazonEventFactory;

class PayWithAmazonEvent extends AmazonMwsModel
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PayWithAmazonEventFactory::new();
    }
}

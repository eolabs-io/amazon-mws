<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\ServiceFeeEventFactory;

class ServiceFeeEvent extends AmazonMwsModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'amazon_order_id',
                    'fee_reason',
                    'seller_sku',
                    'fn_sku',
                    'fee_description',
                    'asin',
                ];

    public function feeList()
    {
        return $this->belongsToMany(FeeComponent::class, 'fee_component_service_fee_list');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ServiceFeeEventFactory::new();
    }
}

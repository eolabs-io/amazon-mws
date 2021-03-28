<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\ServiceProviderCreditEventFactory;

class ServiceProviderCreditEvent extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'provider_transaction_type',
                    'seller_order_id',
                    'marketplace_id',
                    'marketplace_country_code',
                    'seller_id',
                    'seller_store_name',
                    'provider_id',
                    'provider_store_name',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ServiceProviderCreditEventFactory::new();
    }
}

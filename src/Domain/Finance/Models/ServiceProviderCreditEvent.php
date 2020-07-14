<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;


class ServiceProviderCreditEvent extends Model
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

}
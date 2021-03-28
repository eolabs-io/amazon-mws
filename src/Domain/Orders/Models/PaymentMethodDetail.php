<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\PaymentMethodDetailFactory;

class PaymentMethodDetail extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'payment_method_detail',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PaymentMethodDetailFactory::new();
    }
}

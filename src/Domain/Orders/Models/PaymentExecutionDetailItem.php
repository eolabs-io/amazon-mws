<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\PaymentExecutionDetailItemFactory;

class PaymentExecutionDetailItem extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'money_id',
                    'payment_method',
                    'order_id',
                ];

    public function payment()
    {
        return $this->belongsTo(Money::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PaymentExecutionDetailItemFactory::new();
    }
}

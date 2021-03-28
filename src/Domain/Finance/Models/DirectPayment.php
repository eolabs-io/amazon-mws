<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Database\Factories\DirectPaymentFactory;

class DirectPayment extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'direct_payment_type',
                    'direct_payment_amount_id',
                ];

    protected $hidden = ['pivot'];

    public function directPaymentAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'direct_payment_amount_id', 'id')->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return DirectPaymentFactory::new();
    }
}

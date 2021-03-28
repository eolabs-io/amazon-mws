<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeInstrument;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryItem;
use EolabsIo\AmazonMws\Database\Factories\DebtRecoveryEventFactory;

class DebtRecoveryEvent extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'debt_recovery_type',
                    'recovery_amount_id',
                    'over_payment_credit_id',
                ];

    protected $hidden = ['pivot'];

    public function recoveryAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'recovery_amount_id', 'id')->withDefault();
    }

    public function overPaymentCredit()
    {
        return $this->belongsTo(CurrencyAmount::class, 'over_payment_credit_id', 'id')->withDefault();
    }

    public function debtRecoveryItemList()
    {
        return $this->belongsToMany(DebtRecoveryItem::class);
    }

    public function chargeInstrumentList()
    {
        return $this->belongsToMany(ChargeInstrument::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return DebtRecoveryEventFactory::new();
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeInstrument;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryItem;
use Illuminate\Database\Eloquent\Model;


class DebtRecoveryEvent extends Model
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
}
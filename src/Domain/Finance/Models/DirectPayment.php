<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class DirectPayment extends Model
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

}
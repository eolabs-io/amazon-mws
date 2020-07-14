<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class NetworkComminglingTransactionEvent extends Model
{
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'posted_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'posted_date',
                    'net_co_transaction_id',
                    'swap_reason',
                    'transaction_type',
                    'asin',
                    'marketplace_id',
                    'tax_exclusive_amount_id',
                    'tax_amount_id',                    
				];
    

	public function taxExclusiveAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'tax_exclusive_amount_id', 'id')->withDefault();
	}

	public function taxAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'tax_amount_id', 'id')->withDefault();
	}

}
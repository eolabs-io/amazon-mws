<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class ProductAdsPaymentEvent extends Model
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
                    'transaction_type',
                    'invoice_id',
                    'base_value_id',
                    'tax_value_id',
                    'transaction_value_id',
				];
    
    protected $hidden = ['pivot'];

    public function baseValue()
    {
        return $this->belongsTo(CurrencyAmount::class, 'base_value_id', 'id')->withDefault();
    }

    public function taxValue()
    {
        return $this->belongsTo(CurrencyAmount::class, 'tax_value_id', 'id')->withDefault();
    }

    public function transactionValue()
    {
        return $this->belongsTo(CurrencyAmount::class, 'transaction_value_id', 'id')->withDefault();
    }
}
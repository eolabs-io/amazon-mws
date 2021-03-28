<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Database\Factories\FeeComponentFactory;

class FeeComponent extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'fee_type',
                    'fee_amount_id',
                ];

    protected $hidden = ['pivot'];

    public function feeAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'fee_amount_id', 'id')->withDefault();
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return FeeComponentFactory::new();
    }
}

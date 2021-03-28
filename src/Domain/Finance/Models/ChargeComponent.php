<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Database\Factories\ChargeComponentFactory;

class ChargeComponent extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'charge_type',
                    'charge_amount_id',
                ];

    protected $hidden = ['pivot'];

    public function chargeAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'charge_amount_id', 'id')->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ChargeComponentFactory::new();
    }
}

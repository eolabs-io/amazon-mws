<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Database\Factories\ChargeInstrumentFactory;

class ChargeInstrument extends AmazonMwsModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'description',
                    'tail',
                    'amount_id',
                ];

    protected $hidden = ['pivot'];

    public function amount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'amount_id', 'id')->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ChargeInstrumentFactory::new();
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;


class CurrencyAmount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'currency_code',
                    'currency_amount',
				];

}
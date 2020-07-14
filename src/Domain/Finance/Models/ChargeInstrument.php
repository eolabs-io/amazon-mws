<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class ChargeInstrument extends Model
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

}
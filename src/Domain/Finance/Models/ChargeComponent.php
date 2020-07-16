<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class ChargeComponent extends Model
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

}
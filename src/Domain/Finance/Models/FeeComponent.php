<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class FeeComponent extends Model
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

}
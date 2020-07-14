<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;


class Promotion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'promotion_type',
                    'promotion_id',
                    'promotion_amount_id',
				];

    protected $hidden = ['pivot'];

    protected $with = ['promotionAmount'];

	public function promotionAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'promotion_amount_id', 'id')->withDefault();
	}
}
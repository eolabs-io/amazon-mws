<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class FBALiquidationEvent extends Model
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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fba_liquidation_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'posted_date',
                    'original_removal_order_id',
                    'liquidation_proceeds_amount_id',
                    'liquidation_fee_amount_id',
				];

	public function liquidationProceedsAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'liquidation_proceeds_amount_id', 'id')->withDefault();
	}

	public function liquidationFeeAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'liquidation_fee_amount_id', 'id')->withDefault();
	}

}
<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class AdjustmentEvent extends Model
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
                    'adjustment_type',
                    'adjustment_amount_id',
                    'posted_date',
				];
    
	public function adjustmentAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'adjustment_amount_id', 'id')->withDefault();
	}

    public function adjustmentItemList()
    {
        return $this->hasMany(AdjustmentItem::class);
    }
}
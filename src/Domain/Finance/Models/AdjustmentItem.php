<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class AdjustmentItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'adjustment_event_id',
                    'quantity',
                    'per_unit_amount_id',
                    'total_amount_id',
                    'seller_sku',
                    'fn_sku',
                    'product_description',
                    'asin',
				];
    
    public function adjustmentEvent()
    {
        return $this->belongsTo(AdjustmentEvent::class);
    }

	public function perUnitAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'per_unit_amount_id', 'id')->withDefault();
	}

    public function totalAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'total_amount_id', 'id')->withDefault();
    }
}
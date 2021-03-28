<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;
use EolabsIo\AmazonMws\Database\Factories\AdjustmentItemFactory;

class AdjustmentItem extends AmazonMwsModel
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return AdjustmentItemFactory::new();
    }
}

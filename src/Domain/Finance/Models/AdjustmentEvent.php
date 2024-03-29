<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Database\Factories\AdjustmentEventFactory;

class AdjustmentEvent extends AmazonMwsModel
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return AdjustmentEventFactory::new();
    }
}

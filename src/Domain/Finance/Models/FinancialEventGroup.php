<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Database\Factories\FinancialEventGroupFactory;

class FinancialEventGroup extends AmazonMwsModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fund_transfer_date' => 'datetime',
        'financial_event_group_start' => 'datetime',
        'financial_event_group_end' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'financial_event_group_id',
                    'processing_status',
                    'fund_transfer_status',
                    'original_total_id',
                    'converted_total_id',
                    'fund_transfer_date',
                    'trace_id',
                    'account_tail',
                    'beginning_balance_id',
                    'financial_event_group_start',
                    'financial_event_group_end',
                ];

    public function originalTotal()
    {
        return $this->belongsTo(CurrencyAmount::class, 'original_total_id', 'id')->withDefault();
    }

    public function convertedTotal()
    {
        return $this->belongsTo(CurrencyAmount::class, 'converted_total_id', 'id')->withDefault();
    }

    public function beginningBalance()
    {
        return $this->belongsTo(CurrencyAmount::class, 'beginning_balance_id', 'id')->withDefault();
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return FinancialEventGroupFactory::new();
    }
}

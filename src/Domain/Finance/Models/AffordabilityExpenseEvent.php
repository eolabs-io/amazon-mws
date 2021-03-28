<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Database\Factories\AffordabilityExpenseEventFactory;

class AffordabilityExpenseEvent extends AmazonMwsModel
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
                    'posted_date',
                    'transaction_type',
                    'amazon_order_id',
                    'base_expense_id',
                    'total_expense_id',
                    'tax_type_igst_id',
                    'tax_type_cgst_id',
                    'tax_type_sgst_id',
                    'marketplace_id',
                ];


    public function baseExpense()
    {
        return $this->belongsTo(CurrencyAmount::class, 'base_expense_id', 'id')->withDefault();
    }

    public function totalExpense()
    {
        return $this->belongsTo(CurrencyAmount::class, 'total_expense_id', 'id')->withDefault();
    }

    public function taxTypeIGST()
    {
        return $this->belongsTo(CurrencyAmount::class, 'tax_type_igst_id', 'id')->withDefault();
    }

    public function taxTypeCGST()
    {
        return $this->belongsTo(CurrencyAmount::class, 'tax_type_cgst_id', 'id')->withDefault();
    }

    public function taxTypeSGST()
    {
        return $this->belongsTo(CurrencyAmount::class, 'tax_type_sgst_id', 'id')->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return AffordabilityExpenseEventFactory::new();
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class AffordabilityExpenseReversalEvent extends Model
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

}
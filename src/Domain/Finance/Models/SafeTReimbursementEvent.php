<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementItem;
use Illuminate\Database\Eloquent\Model;


class SafeTReimbursementEvent extends Model
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
                        'safe_t_claim_id',
                        'reimbursed_amount_id',
    ];


    public function reimbursedAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'reimbursed_amount_id');
    }
    
	public function safeTReimbursementItemList()
	{
		return $this->hasMany(SafeTReimbursementItem::class);
	}
}
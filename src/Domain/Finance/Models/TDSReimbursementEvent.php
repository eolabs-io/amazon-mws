<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class TDSReimbursementEvent extends Model
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
    protected $table = 'tds_reimbursement_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'posted_date',
                    'tds_order_id',
                    'reimbursed_amount_id',                    
				];
    

	public function reimbursedAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'reimbursed_amount_id', 'id')->withDefault();
	}

}
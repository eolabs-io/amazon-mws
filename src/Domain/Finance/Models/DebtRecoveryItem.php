<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class DebtRecoveryItem extends Model
{
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
    	'group_begin_date' => 'datetime',
        'group_end_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'recovery_amount_id',
                    'original_amount_id',
                    'group_begin_date',
                    'group_end_date',
				];

    protected $hidden = ['pivot'];

	public function recoveryAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'recovery_amount_id', 'id')->withDefault();
	}

	public function originalAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'original_amount_id', 'id')->withDefault();
	}

}
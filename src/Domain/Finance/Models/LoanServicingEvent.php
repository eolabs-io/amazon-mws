<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Illuminate\Database\Eloquent\Model;


class LoanServicingEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'source_business_event_type',
                    'loan_amount_id',
				];

	public function loanAmount()
	{
		return $this->belongsTo(CurrencyAmount::class, 'loan_amount_id', 'id')->withDefault();
	}

}
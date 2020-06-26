<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use Illuminate\Database\Eloquent\Model;


class PaymentExecutionDetailItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    				'money_id',
                    'payment_method',
                    'order_id',
				];

	public function payment()
	{
		return $this->belongsTo(Money::class);
	}

}
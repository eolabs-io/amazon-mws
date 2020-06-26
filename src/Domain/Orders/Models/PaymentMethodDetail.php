<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Model;


class PaymentMethodDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'payment_method_detail',
				];

}
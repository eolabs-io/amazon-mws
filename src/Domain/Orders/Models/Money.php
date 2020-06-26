<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Model;


class Money extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'currency_code',
                    'amount',
				];

}
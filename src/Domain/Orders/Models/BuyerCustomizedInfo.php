<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Model;


class BuyerCustomizedInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'customized_url',
				];

}
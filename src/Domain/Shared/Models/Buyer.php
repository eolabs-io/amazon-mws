<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'email',
                    'name',
                    'address_1',
                    'address_2',
                    'address_3',
                    'city',
                    'state',
                    'postal_code',
                    'country',
                    'phone_number',
                ];
}

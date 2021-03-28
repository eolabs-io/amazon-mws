<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Models;

use EolabsIo\AmazonMws\Database\Factories\BuyerFactory;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;

class Buyer extends AmazonMwsModel
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return BuyerFactory::new();
    }
}

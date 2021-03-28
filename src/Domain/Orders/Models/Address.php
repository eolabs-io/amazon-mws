<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Database\Factories\AddressFactory;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;

class Address extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name',
                    'address_line_1',
                    'address_line_2',
                    'address_line_3',
                    'city',
                    'municipality',
                    'county',
                    'district',
                    'state_or_region',
                    'postal_code',
                    'country_code',
                    'phone',
                    'address_type',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return AddressFactory::new();
    }
}

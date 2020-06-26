<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Model;


class Address extends Model
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

}
<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use Illuminate\Database\Eloquent\Model;


class PackageDimension extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
							'height', 
							'length', 
                            'width',
							'weight', 
                            'dimension_units',
							'weight_units',
    					];

}
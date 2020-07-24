<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use Illuminate\Database\Eloquent\Model;


class ItemDimension extends Model
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
							'units',
    					];

}

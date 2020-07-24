<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use Illuminate\Database\Eloquent\Model;


class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
							'url', 
							'height', 
							'width', 
							'units',
    					];

}
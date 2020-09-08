<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'asin',
                            'rating',
                        ];
}

<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Models;

use EolabsIo\AmazonMws\Database\Factories\TimepointFactory;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;

class Timepoint extends AmazonMwsModel
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_time' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'timepoint_type',
                    'date_time',
                ];


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return TimepointFactory::new();
    }
}

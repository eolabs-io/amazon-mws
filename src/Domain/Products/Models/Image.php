<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use EolabsIo\AmazonMws\Database\Factories\ImageFactory;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;

class Image extends AmazonMwsModel
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ImageFactory::new();
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\ProductReviewStatusFactory;

class ProductReviewStatus extends AmazonMwsModel
{
    public $incrementing = false;

    protected $casts = [
        'in_use' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'description',
        'in_use',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ProductReviewStatusFactory::new();
    }
}

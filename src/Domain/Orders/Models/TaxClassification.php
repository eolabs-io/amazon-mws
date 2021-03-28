<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\TaxClassificationFactory;

class TaxClassification extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name',
                    'value',
                    'buyer_tax_info_id',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return TaxClassificationFactory::new();
    }
}

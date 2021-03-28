<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\BuyerTaxInfoFactory;
use EolabsIo\AmazonMws\Domain\Orders\Models\TaxClassification;

class BuyerTaxInfo extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'company_legal_name',
                    'taxing_region',
                ];

    public function taxClassifications()
    {
        $this->belongsToMany(TaxClassification::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return BuyerTaxInfoFactory::new();
    }
}

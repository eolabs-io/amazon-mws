<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Database\Factories\TaxWithheldComponentFactory;

class TaxWithheldComponent extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'tax_collection_model',
                ];

    protected $hidden = ['pivot'];

    public function taxesWithheld()
    {
        return $this->belongsToMany(ChargeComponent::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return TaxWithheldComponentFactory::new();
    }
}

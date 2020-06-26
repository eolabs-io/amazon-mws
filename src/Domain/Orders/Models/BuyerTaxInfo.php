<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Domain\Orders\Models\TaxClassification;
use Illuminate\Database\Eloquent\Model;


class BuyerTaxInfo extends Model
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
}
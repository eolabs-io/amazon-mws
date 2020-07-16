<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use Illuminate\Database\Eloquent\Model;


class TaxWithheldComponent extends Model
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

}
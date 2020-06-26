<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Model;


class TaxClassification extends Model
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

}
<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Model;


class TaxCollection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'model',
                    'responsible_party',
				];

}
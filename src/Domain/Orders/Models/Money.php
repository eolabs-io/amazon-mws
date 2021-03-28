<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Database\Factories\MoneyFactory;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;

class Money extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'currency_code',
                    'amount',
                ];


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return MoneyFactory::new();
    }
}

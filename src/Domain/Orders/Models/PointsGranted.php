<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\PointsGrantedFactory;

class PointsGranted extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'points_number',
                    'points_monetary_value_id',
                ];

    public function pointsMonetaryValue()
    {
        return $this->belongsTo(Money::class, 'points_monetary_value_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PointsGrantedFactory::new();
    }
}

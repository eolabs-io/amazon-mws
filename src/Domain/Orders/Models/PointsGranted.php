<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use Illuminate\Database\Eloquent\Model;


class PointsGranted extends Model
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

}
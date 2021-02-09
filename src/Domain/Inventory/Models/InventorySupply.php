<?php

namespace EolabsIo\AmazonMws\Domain\Inventory\Models;

use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupplyDetail;
use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;
use Illuminate\Database\Eloquent\Model;

class InventorySupply extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'in_use' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'seller_sku',
                    'fnsku',
                    'asin',
                    'condition',
                    'total_supply_quantity',
                    'in_stock_supply_quantity',
                    'earliest_availability_id',
                    'in_use',
                ];


    public function earliestAvailability()
    {
        return $this->belongsTo(Timepoint::class, 'earliest_availability_id', 'id')->withDefault();
    }

    public function details()
    {
        return $this->hasMany(InventorySupplyDetail::class, 'inventory_supply_id', 'id');
    }
}

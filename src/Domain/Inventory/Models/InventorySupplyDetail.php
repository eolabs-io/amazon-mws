<?php

namespace EolabsIo\AmazonMws\Domain\Inventory\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\InventorySupplyDetailFactory;

class InventorySupplyDetail extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'inventory_supply_id',
                    'quantity',
                    'supply_type',
                    'earliest_available_to_pick_id',
                    'latest_available_to_pick_id',
                ];

    public function earliestAvailableToPick()
    {
        return $this->belongsTo(Timepoint::class, 'earliest_available_to_pick_id', 'id')->withDefault();
    }

    public function latestAvailableToPick()
    {
        return $this->belongsTo(Timepoint::class, 'latest_available_to_pick_id', 'id')->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return InventorySupplyDetailFactory::new();
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Inventory\Jobs;

use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupply;
use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupplyDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ProcessInventoryListResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Illuminate\Support\Collection */
    public $results;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $results)
    {
        $this->results = $results;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->persistInventorySupply();
    }

    public function persistInventorySupply()
    {
        $items = data_get($this->results, 'InventorySupplyList');
        array_walk($items, [$this,'createInventorySupplyList']);
    }

    public function createInventorySupplyList($inventorySupplyList)
    {

        $attributes = [ 'seller_sku' => data_get($inventorySupplyList, 'SellerSKU'),
                        'fnsku' => data_get($inventorySupplyList, 'FNSKU'),
                        'asin' => data_get($inventorySupplyList, 'ASIN'), ];
        
        $values = [ 'condition' => data_get($inventorySupplyList, 'Condition'),
                    'total_supply_quantity' => data_get($inventorySupplyList, 'TotalSupplyQuantity'),
                    'in_stock_supply_quantity' => data_get($inventorySupplyList, 'InStockSupplyQuantity'), ];

        $inventorySupply = InventorySupply::updateOrCreate($attributes, $values);


        $this->associateEarliestAvailability($inventorySupplyList, $inventorySupply);
        $this->createSupplyDetails($inventorySupplyList, $inventorySupply);
    }

    public function associateEarliestAvailability($inventorySupplyList, InventorySupply $inventorySupply)
    {
        if (!Arr::has($inventorySupplyList, 'EarliestAvailability')) {
            return;
        }

        $timepoint = [
            'timepoint_type' => data_get($inventorySupplyList, 'EarliestAvailability.TimepointType'),
            'date_time' => data_get($inventorySupplyList, 'EarliestAvailability.DateTime'),
        ];

        $earliestAvailability = $inventorySupply->earliestAvailability;
        $earliestAvailability->fill($timepoint)->save();

        $inventorySupply->earliestAvailability()
                        ->associate($earliestAvailability);

        $inventorySupply->save();
    }

    public function createSupplyDetails($inventorySupplyList, InventorySupply $inventorySupply)
    {
        if (!Arr::has($inventorySupplyList, 'SupplyDetail')) {
            return;
        }
        
        $inventorySupply->details()->delete();
        
        $details = data_get($inventorySupplyList, 'SupplyDetail');
        array_walk($details, [$this,'createSupplyDetail'], $inventorySupply);
    }

    public function createSupplyDetail($supplyDetail, $key, InventorySupply $inventorySupply)
    {
        $inventorySupplyDetail =  $inventorySupply->details()->make([
            'quantity' => data_get($supplyDetail, 'Quantity'),
            'supply_type' => data_get($supplyDetail, 'SupplyType'),
        ]);

        $earliestAvailability = $inventorySupplyDetail->earliestAvailableToPick->create([
            'timepoint_type' => data_get($supplyDetail, 'EarliestAvailableToPick.TimepointType'),
            'date_time' => data_get($supplyDetail, 'EarliestAvailableToPick.DateTime'),
        ]);

        $latestAvailableToPick = $inventorySupplyDetail->latestAvailableToPick->fill([
            'timepoint_type' => data_get($supplyDetail, 'LatestAvailableToPick.TimepointType'),
            'date_time' => data_get($supplyDetail, 'LatestAvailableToPick.DateTime'),
        ]);

        $inventorySupplyDetail->earliestAvailableToPick()->associate($earliestAvailability);
        $inventorySupplyDetail->latestAvailableToPick()->associate($latestAvailableToPick);

        $inventorySupply->details()->save($inventorySupplyDetail);
    }
}

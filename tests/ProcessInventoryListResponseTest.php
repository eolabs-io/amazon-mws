<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMws\Domain\Inventory\Jobs\ProcessInventoryListResponse;
use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupply;
use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupplyDetail;
use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;
use EolabsIo\AmazonMws\Support\Facades\InventoryList;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesInventoryList;
use EolabsIo\AmazonMws\Tests\Factories\InventoryFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;


class ProcessInventoryListResponseTest extends TestCase
{

    use RefreshDatabase,
        CreatesInventoryList;

    /** @test */
    public function it_can_process_inventory_list_response()
    {
        $inventoryFactory = $this->createInventoryList();

        $results = $inventoryFactory->fetch();

        (new ProcessInventoryListResponse($results))->handle();

        $this->assertDatabaseHas('timepoints', [  "timepoint_type" => "Immediately",
                                                  "date_time" => null
                                                ]);


        $this->assertDatabaseHas('inventory_supplies', [  "seller_sku" => "SampleSKU1",
                                                          "fnsku" => "X0000000FM",
                                                          "asin" => "B00000K3CQ",
                                                          "condition" => "NewItem",
                                                          "total_supply_quantity" => "20",
                                                          "in_stock_supply_quantity" => "15",
                                                      ]);

        $this->assertDatabaseHas('inventory_supplies', [  "seller_sku" => "SampleSKU2",
                                                          "fnsku" => "X00008FZR1",
                                                          "asin" => "B00004RWQR",
                                                          "condition" => "UsedLikeNew",
                                                          "total_supply_quantity" => "0",
                                                          "in_stock_supply_quantity" => "0",
                                                      ]);

        $this->assertDatabaseHas('inventory_supply_details', [ "quantity" => "1",
                                                               "supply_type" => "Normal",
                                                          ]);

    }

}
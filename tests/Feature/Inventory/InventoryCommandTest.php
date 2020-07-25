<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Inventory;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Inventory\Command\Inventory as InventoryCommand;
use EolabsIo\AmazonMws\Domain\Inventory\Events\FetchInventoryList;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

class InventoryCommandTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_inventory_artisan_command()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:inventory '.$store->id.' --detailed-response-group')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchInventoryList::class, function($event){
            $inventoryList = $event->inventoryList;
            
            return $inventoryList->getResponseGroup() === 'Detailed';
        });

    }

    /** @test */
    public function it_can_execute_inventory_artisan_command_with_querystartdatetime()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:inventory '.$store->id.' --query-start-date-time=2020-06-27T14:10:00.000-06:00')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchInventoryList::class, function($event){
            $inventoryList = $event->inventoryList;

            return $inventoryList->getQueryStartDateTime() === '2020-06-27T20:10:00Z' &&
                   $inventoryList->getResponseGroup() === 'Basic';
        });

    }

    /** @test */
    public function it_can_execute_inventory_artisan_command_with_seller_skus()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:inventory '.$store->id.' --seller-skus=SampleSKU1 --seller-skus=SampleSKU2')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchInventoryList::class, function($event){
            $inventoryList = $event->inventoryList;

            return $inventoryList->getSellerSkus() === ['SampleSKU1', 'SampleSKU2'] &&
                   $inventoryList->getResponseGroup() === 'Basic';
        });

    }
}
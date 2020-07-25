<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Orders;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrders;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

class OrdersCommandTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_inventory_artisan_command_with_last_updated_after()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:orders '.$store->id.' --last-updated-after=2020-06-27T14:10:00.000-06:00')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListOrders::class, function($event){
            $listOrders = $event->listOrders;
            
            return $listOrders->getLastUpdatedAfter() === '2020-06-27T20:10:00Z';
        });

    }

    /** @test */
    public function it_can_execute_inventory_artisan_command_with_last_updated_before()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:orders '.$store->id.' --last-updated-before=2020-06-27T14:10:00.000-06:00')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListOrders::class, function($event){
            $listOrders = $event->listOrders;
            
            return $listOrders->getLastUpdatedBefore() === '2020-06-27T20:10:00Z';
        });

    }

    /** @test */
    public function it_can_execute_inventory_artisan_command_with_created_after()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:orders '.$store->id.' --created-after=2020-06-27T14:10:00.000-06:00')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListOrders::class, function($event){
            $listOrders = $event->listOrders;
            
            return $listOrders->getCreatedAfter() === '2020-06-27T20:10:00Z';
        });

    }

    /** @test */
    public function it_can_execute_inventory_artisan_command_with_created_before()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:orders '.$store->id.' --created-before=2020-06-27T14:10:00.000-06:00')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListOrders::class, function($event){
            $listOrders = $event->listOrders;
            
            return $listOrders->getCreatedBefore() === '2020-06-27T20:10:00Z';
        });

    }

}
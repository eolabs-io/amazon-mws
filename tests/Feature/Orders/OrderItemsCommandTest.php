<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Orders;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

class OrderItemsCommandTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_order_items_artisan_command()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:order-items '.$store->id.' --amazon-order-id=058-1233752-8214740')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListOrderItems::class, function($event){
            $listOrderItems = $event->listOrderItems;
            
            return $listOrderItems->getAmazonOrderId() === '058-1233752-8214740';
        });

    }

    /** @test */
    public function it_can_execute_order_items_artisan_command_with_discover_option()
    {

        $store = factory(Store::class)->create();

        factory(Order::class, 10)->create();
        factory(OrderItem::class, 10)->create();

        $this->artisan('amazonmws:order-items '.$store->id.' --discover')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListOrderItems::class, 10);

        $this->assertEquals(Order::count(), 20);
    }


}
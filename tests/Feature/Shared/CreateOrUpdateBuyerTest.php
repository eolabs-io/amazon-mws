<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Shared;

use Illuminate\Support\Facades\Event;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\AmazonMws\Domain\Shared\Listeners\CreateOrUpdateBuyer;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;
use EolabsIo\AmazonMws\Domain\Reports\Events\AmazonFulfilledShipmentWasCreated;

class CreateOrUpdateBuyerTest extends TestCase
{
    use RefreshDatabase;

    public $shipment;
    public $event;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();

        $this->shipment = AmazonFulfilledShipment::factory()->create();
        $this->event = new AmazonFulfilledShipmentWasCreated($this->shipment);
    }

    /** @test */
    public function it_created_buyer()
    {
        $this->assertDatabaseCount('buyers', 0);

        (new CreateOrUpdateBuyer())->handle($this->event);

        $this->assertDatabaseCount('buyers', 1);
    }
}

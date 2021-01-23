<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use Illuminate\Support\Facades\Event;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;
use EolabsIo\AmazonMws\Domain\Reports\Events\AmazonFulfilledShipmentWasCreated;
use EolabsIo\AmazonMws\Domain\Reports\Events\AmazonFulfilledShipmentWasUpdated;

class AmazonFulfilledShipmentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return AmazonFulfilledShipment::class;
    }

    /** @test */
    public function it_can_create_a_model()
    {
        Event::fake();

        parent::it_can_create_a_model();

        Event::assertDispatched(AmazonFulfilledShipmentWasCreated::class);
    }

    /** @test */
    public function it_can_update_a_model()
    {
        Event::fake();

        parent::it_can_update_a_model();

        Event::assertDispatched(AmazonFulfilledShipmentWasUpdated::class);
    }
}

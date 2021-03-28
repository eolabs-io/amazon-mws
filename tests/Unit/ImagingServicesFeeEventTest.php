<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\ImagingServicesFeeEvent;

class ImagingServicesFeeEventTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ImagingServicesFeeEvent::class;
    }

    /** @test */
    public function it_has_imagingServicesFeeEvent_relationship()
    {
        $imagingServicesFeeEvent = ImagingServicesFeeEvent::factory()->create();
        $feeList = FeeComponent::factory()->times(3)->create();

        $imagingServicesFeeEvent->feeList()->toggle($feeList);

        $this->assertArraysEqual($feeList->toArray(), $imagingServicesFeeEvent->feeList->toArray());
    }
}

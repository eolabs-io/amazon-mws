<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceFeeEvent;

class ServiceFeeEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return ServiceFeeEvent::class;
    }

    /** @test */
    public function it_has_feeList_relationship()
    {
        $serviceFeeEvent = factory(ServiceFeeEvent::class)->create();
        $feeList = factory(FeeComponent::class, 3)->create();

        $serviceFeeEvent->feeList()->toggle($feeList);

        $this->assertArraysEqual($feeList->toArray(), $serviceFeeEvent->feeList->toArray());
    }
}

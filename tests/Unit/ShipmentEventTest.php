<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\DirectPayment;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentItem;


class ShipmentEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return ShipmentEvent::class;
    }

    /** @test */
    public function it_has_orderChargeList_relationship()
    {
        $shipmentEvent = $this->factory()->create();
        $orderChargeList = factory(ChargeComponent::class, 3)->create();

        $shipmentEvent->orderChargeList()->toggle($orderChargeList);

        $this->assertArraysEqual($orderChargeList->toArray(), $shipmentEvent->orderChargeList->toArray());
    }

    /** @test */
    public function it_has_orderChargeAdjustmentList_relationship()
    {
        $shipmentEvent = $this->factory()->create();
        $orderChargeAdjustmentList = factory(ChargeComponent::class, 3)->create();

        $shipmentEvent->orderChargeAdjustmentList()->toggle($orderChargeAdjustmentList);

        $this->assertArraysEqual($orderChargeAdjustmentList->toArray(), $shipmentEvent->orderChargeAdjustmentList->toArray());
    }

    /** @test */
    public function it_has_shipmentFeeList_relationship()
    {
        $shipmentEvent = $this->factory()->create();
        $shipmentFeeList = factory(FeeComponent::class, 3)->create();

        $shipmentEvent->shipmentFeeList()->toggle($shipmentFeeList);

        $this->assertArraysEqual($shipmentFeeList->toArray(), $shipmentEvent->shipmentFeeList->toArray());
    }

    /** @test */
    public function it_has_shipmentFeeAdjustmentList_relationship()
    {
        $shipmentEvent = $this->factory()->create();
        $shipmentFeeAdjustmentList = factory(FeeComponent::class, 3)->create();

        $shipmentEvent->shipmentFeeAdjustmentList()->toggle($shipmentFeeAdjustmentList);

        $this->assertArraysEqual($shipmentFeeAdjustmentList->toArray(), $shipmentEvent->shipmentFeeAdjustmentList->toArray());
    }

    /** @test */
    public function it_has_orderFeeList_relationship()
    {
        $shipmentEvent = $this->factory()->create();
        $orderFeeList = factory(FeeComponent::class, 3)->create();

        $shipmentEvent->orderFeeList()->toggle($orderFeeList);

        $this->assertArraysEqual($orderFeeList->toArray(), $shipmentEvent->orderFeeList->toArray());
    }

    /** @test */
    public function it_has_orderFeeAdjustmentList_relationship()
    {
        $shipmentEvent = $this->factory()->create();
        $orderFeeAdjustmentList = factory(FeeComponent::class, 3)->create();

        $shipmentEvent->orderFeeAdjustmentList()->toggle($orderFeeAdjustmentList);

        $this->assertArraysEqual($orderFeeAdjustmentList->toArray(), $shipmentEvent->orderFeeAdjustmentList->toArray());
    }

    /** @test */
    public function it_has_directPaymentList_relationship()
    {
        $shipmentEvent = $this->factory()->create();
        $directPaymentList = factory(DirectPayment::class, 3)->create();

        $shipmentEvent->directPaymentList()->toggle($directPaymentList);

        $this->assertArraysEqual($directPaymentList->toArray(), $shipmentEvent->directPaymentList->toArray());
    }

    /** @test */
    public function it_has_shipmentItemList_relationship()
    {
        $shipmentEvent = $this->factory()->create();
        $shipmentItemList = factory(ShipmentItem::class, 3)->create();

        $shipmentEvent->shipmentItemList()->toggle($shipmentItemList);

        $this->assertArraysEqual($shipmentItemList->toArray(), $shipmentEvent->shipmentItemList->toArray());
    }

    /** @test */
    public function it_has_shipmentItemAdjustmentList_relationship()
    {
        $shipmentEvent = $this->factory()->create();
        $shipmentItemAdjustmentList = factory(ShipmentItem::class, 3)->create();

        $shipmentEvent->shipmentItemAdjustmentList()->toggle($shipmentItemAdjustmentList);

        $this->assertArraysEqual($shipmentItemAdjustmentList->toArray(), $shipmentEvent->shipmentItemAdjustmentList->toArray());
    }
}

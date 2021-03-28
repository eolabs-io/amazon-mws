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
        $shipmentEvent = $this->modelClass::factory()->create();
        $orderChargeList = ChargeComponent::factory()->times(3)->create();

        $shipmentEvent->orderChargeList()->toggle($orderChargeList);

        $this->assertArraysEqual($orderChargeList->toArray(), $shipmentEvent->orderChargeList->toArray());
    }

    /** @test */
    public function it_has_orderChargeAdjustmentList_relationship()
    {
        $shipmentEvent = $this->modelClass::factory()->create();
        $orderChargeAdjustmentList = ChargeComponent::factory()->times(3)->create();

        $shipmentEvent->orderChargeAdjustmentList()->toggle($orderChargeAdjustmentList);

        $this->assertArraysEqual($orderChargeAdjustmentList->toArray(), $shipmentEvent->orderChargeAdjustmentList->toArray());
    }

    /** @test */
    public function it_has_shipmentFeeList_relationship()
    {
        $shipmentEvent = $this->modelClass::factory()->create();
        $shipmentFeeList = FeeComponent::factory()->times(3)->create();

        $shipmentEvent->shipmentFeeList()->toggle($shipmentFeeList);

        $this->assertArraysEqual($shipmentFeeList->toArray(), $shipmentEvent->shipmentFeeList->toArray());
    }

    /** @test */
    public function it_has_shipmentFeeAdjustmentList_relationship()
    {
        $shipmentEvent = $this->modelClass::factory()->create();
        $shipmentFeeAdjustmentList = FeeComponent::factory()->times(3)->create();

        $shipmentEvent->shipmentFeeAdjustmentList()->toggle($shipmentFeeAdjustmentList);

        $this->assertArraysEqual($shipmentFeeAdjustmentList->toArray(), $shipmentEvent->shipmentFeeAdjustmentList->toArray());
    }

    /** @test */
    public function it_has_orderFeeList_relationship()
    {
        $shipmentEvent = $this->modelClass::factory()->create();
        $orderFeeList = FeeComponent::factory()->times(3)->create();

        $shipmentEvent->orderFeeList()->toggle($orderFeeList);

        $this->assertArraysEqual($orderFeeList->toArray(), $shipmentEvent->orderFeeList->toArray());
    }

    /** @test */
    public function it_has_orderFeeAdjustmentList_relationship()
    {
        $shipmentEvent = $this->modelClass::factory()->create();
        $orderFeeAdjustmentList = FeeComponent::factory()->times(3)->create();

        $shipmentEvent->orderFeeAdjustmentList()->toggle($orderFeeAdjustmentList);

        $this->assertArraysEqual($orderFeeAdjustmentList->toArray(), $shipmentEvent->orderFeeAdjustmentList->toArray());
    }

    /** @test */
    public function it_has_directPaymentList_relationship()
    {
        $shipmentEvent = $this->modelClass::factory()->create();
        $directPaymentList = DirectPayment::factory()->times(3)->create();

        $shipmentEvent->directPaymentList()->toggle($directPaymentList);

        $this->assertArraysEqual($directPaymentList->toArray(), $shipmentEvent->directPaymentList->toArray());
    }

    /** @test */
    public function it_has_shipmentItemList_relationship()
    {
        $shipmentEvent = $this->modelClass::factory()->create();
        $shipmentItemList = ShipmentItem::factory()->times(3)->create();

        $shipmentEvent->shipmentItemList()->toggle($shipmentItemList);

        $this->assertArraysEqual($shipmentItemList->toArray(), $shipmentEvent->shipmentItemList->toArray());
    }

    /** @test */
    public function it_has_shipmentItemAdjustmentList_relationship()
    {
        $shipmentEvent = $this->modelClass::factory()->create();
        $shipmentItemAdjustmentList = ShipmentItem::factory()->times(3)->create();

        $shipmentEvent->shipmentItemAdjustmentList()->toggle($shipmentItemAdjustmentList);

        $this->assertArraysEqual($shipmentItemAdjustmentList->toArray(), $shipmentEvent->shipmentItemAdjustmentList->toArray());
    }
}

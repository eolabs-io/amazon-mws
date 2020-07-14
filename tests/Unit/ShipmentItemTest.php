<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\Promotion;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;

class ShipmentItemTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return ShipmentItem::class;
    }

    /** @test */
    public function it_has_itemChargeList_relationship()
    {
        $shipmentItem = factory(ShipmentItem::class)->create();
        $itemChargeList = factory(ChargeComponent::class, 3)->create();

        $shipmentItem->itemChargeList()->toggle($itemChargeList);

        $this->assertArraysEqual($itemChargeList->toArray(), $shipmentItem->itemChargeList->toArray());
    }

    /** @test */
    public function it_has_itemTaxWithheldList_relationship()
    {
        $shipmentItem = factory(ShipmentItem::class)->create();
        $itemTaxWithheldList = factory(TaxWithheldComponent::class, 3)->create();

        $shipmentItem->itemTaxWithheldList()->toggle($itemTaxWithheldList);

        $this->assertArraysEqual($itemTaxWithheldList->toArray(), $shipmentItem->itemTaxWithheldList->toArray());
    }

    /** @test */
    public function it_has_itemChargeAdjustmentList_relationship()
    {
        $shipmentItem = factory(ShipmentItem::class)->create();
        $itemChargeAdjustmentList = factory(ChargeComponent::class, 3)->create();

        $shipmentItem->itemChargeAdjustmentList()->toggle($itemChargeAdjustmentList);

        $this->assertArraysEqual($itemChargeAdjustmentList->toArray(), $shipmentItem->itemChargeAdjustmentList->toArray());
    }

    /** @test */
    public function it_has_itemFeeList_relationship()
    {
        $shipmentItem = factory(ShipmentItem::class)->create();
        $itemFeeList = factory(FeeComponent::class, 3)->create();

        $shipmentItem->itemFeeList()->toggle($itemFeeList);

        $this->assertArraysEqual($itemFeeList->toArray(), $shipmentItem->itemFeeList->toArray());
    }

    /** @test */
    public function it_has_itemFeeAdjustmentList_relationship()
    {
        $shipmentItem = factory(ShipmentItem::class)->create();
        $itemFeeAdjustmentList = factory(FeeComponent::class, 3)->create();

        $shipmentItem->itemFeeAdjustmentList()->toggle($itemFeeAdjustmentList);

        $this->assertArraysEqual($itemFeeAdjustmentList->toArray(), $shipmentItem->itemFeeAdjustmentList->toArray());
    }

    /** @test */
    public function it_has_promotionList_relationship()
    {
        $shipmentItem = factory(ShipmentItem::class)->create();
        $promotionList = factory(Promotion::class, 3)->create();

        $shipmentItem->promotionList()->toggle($promotionList);

        $this->assertArraysEqual($promotionList->toArray(), $shipmentItem->promotionList->toArray());
    }

    /** @test */
    public function it_has_promotionAdjustmentList_relationship()
    {
        $shipmentItem = factory(ShipmentItem::class)->create();
        $promotionAdjustmentList = factory(Promotion::class, 3)->create();

        $shipmentItem->promotionAdjustmentList()->toggle($promotionAdjustmentList);

        $this->assertArraysEqual($promotionAdjustmentList->toArray(), $shipmentItem->promotionAdjustmentList->toArray());
    }
}

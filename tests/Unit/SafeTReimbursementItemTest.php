<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementItem;

class SafeTReimbursementItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return SafeTReimbursementItem::class;
    }

    /** @test */
    public function safeTReimbursementEvent()
    {
        $safeTReimbursementEvent = SafeTReimbursementEvent::factory()->create();
        $safeTReimbursementItem = SafeTReimbursementItem::factory()->create(['safe_t_reimbursement_event_id' => $safeTReimbursementEvent->id]);

        $this->assertArraysEqual($safeTReimbursementEvent->toArray(), $safeTReimbursementItem->safeTReimbursementEvent->toArray());
    }

    /** @test */
    public function it_has_itemChargeList_relationship()
    {
        $safeTReimbursementItem = SafeTReimbursementItem::factory()->create();
        $itemChargeList = ChargeComponent::factory()->times(3)->create();

        $safeTReimbursementItem->itemChargeList()->toggle($itemChargeList);

        $this->assertArraysEqual($itemChargeList->toArray(), $safeTReimbursementItem->itemChargeList->toArray());
    }
}

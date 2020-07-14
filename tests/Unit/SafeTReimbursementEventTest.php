<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementItem;

class SafeTReimbursementEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return SafeTReimbursementEvent::class;
    }

    /** @test */
    public function it_has_perUnitAmount_relationship()
    {
        $safeTReimbursementEvent = factory(SafeTReimbursementEvent::class)->create(['reimbursed_amount_id' => null]);
        $reimbursedAmount = factory(CurrencyAmount::class)->create();

        $safeTReimbursementEvent->reimbursedAmount()->associate($reimbursedAmount);

        $this->assertArraysEqual($reimbursedAmount->toArray(), $safeTReimbursementEvent->reimbursedAmount->toArray());
    }

    /** @test */
    public function it_has_safeTReimbursementItemList_relationship()
    {
        $safeTReimbursementEvent = factory(SafeTReimbursementEvent::class)->create();
        $safeTReimbursementItemList = factory(SafeTReimbursementItem::class, 3)->create(['safe_t_reimbursement_event_id' => $safeTReimbursementEvent->id]);

        $this->assertArraysEqual($safeTReimbursementItemList->toArray(), $safeTReimbursementEvent->safeTReimbursementItemList->toArray());
    }
}

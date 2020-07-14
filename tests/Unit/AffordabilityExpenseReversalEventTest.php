<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseReversalEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class AffordabilityExpenseReversalEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return AffordabilityExpenseReversalEvent::class;
    }

    /** @test */
    public function it_has_baseExpense_relationship()
    {
        $affordabilityExpenseReversalEvent = factory(AffordabilityExpenseReversalEvent::class)->create(['base_expense_id' => null]);
        $baseExpense = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseReversalEvent->baseExpense()->associate($baseExpense);

        $this->assertArraysEqual($baseExpense->toArray(), $affordabilityExpenseReversalEvent->baseExpense->toArray());
    }

    /** @test */
    public function it_has_totalExpense_relationship()
    {
        $affordabilityExpenseReversalEvent = factory(AffordabilityExpenseReversalEvent::class)->create(['total_expense_id' => null]);
        $totalExpense = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseReversalEvent->totalExpense()->associate($totalExpense);

        $this->assertArraysEqual($totalExpense->toArray(), $affordabilityExpenseReversalEvent->totalExpense->toArray());
    }

    /** @test */
    public function it_has_taxTypeIGST_relationship()
    {
        $affordabilityExpenseReversalEvent = factory(AffordabilityExpenseReversalEvent::class)->create();
        $taxTypeIGST = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseReversalEvent->taxTypeIGST()->associate($taxTypeIGST);

        $this->assertArraysEqual($taxTypeIGST->toArray(), $affordabilityExpenseReversalEvent->taxTypeIGST->toArray());
    }

    /** @test */
    public function it_has_taxTypeCGST_relationship()
    {
        $affordabilityExpenseReversalEvent = factory(AffordabilityExpenseReversalEvent::class)->create();
        $taxTypeCGST = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseReversalEvent->taxTypeCGST()->associate($taxTypeCGST);

        $this->assertArraysEqual($taxTypeCGST->toArray(), $affordabilityExpenseReversalEvent->taxTypeCGST->toArray());
    }

    /** @test */
    public function it_has_taxTypeSGST_relationship()
    {
        $affordabilityExpenseReversalEvent = factory(AffordabilityExpenseReversalEvent::class)->create();
        $taxTypeSGST = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseReversalEvent->taxTypeSGST()->associate($taxTypeSGST);

        $this->assertArraysEqual($taxTypeSGST->toArray(), $affordabilityExpenseReversalEvent->taxTypeSGST->toArray());
    }
}

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
        $affordabilityExpenseReversalEvent = AffordabilityExpenseReversalEvent::factory()->create(['base_expense_id' => null]);
        $baseExpense = CurrencyAmount::factory()->create();

        $affordabilityExpenseReversalEvent->baseExpense()->associate($baseExpense);

        $this->assertArraysEqual($baseExpense->toArray(), $affordabilityExpenseReversalEvent->baseExpense->toArray());
    }

    /** @test */
    public function it_has_totalExpense_relationship()
    {
        $affordabilityExpenseReversalEvent = AffordabilityExpenseReversalEvent::factory()->create(['total_expense_id' => null]);
        $totalExpense = CurrencyAmount::factory()->create();

        $affordabilityExpenseReversalEvent->totalExpense()->associate($totalExpense);

        $this->assertArraysEqual($totalExpense->toArray(), $affordabilityExpenseReversalEvent->totalExpense->toArray());
    }

    /** @test */
    public function it_has_taxTypeIGST_relationship()
    {
        $affordabilityExpenseReversalEvent = AffordabilityExpenseReversalEvent::factory()->create();
        $taxTypeIGST = CurrencyAmount::factory()->create();

        $affordabilityExpenseReversalEvent->taxTypeIGST()->associate($taxTypeIGST);

        $this->assertArraysEqual($taxTypeIGST->toArray(), $affordabilityExpenseReversalEvent->taxTypeIGST->toArray());
    }

    /** @test */
    public function it_has_taxTypeCGST_relationship()
    {
        $affordabilityExpenseReversalEvent = AffordabilityExpenseReversalEvent::factory()->create();
        $taxTypeCGST = CurrencyAmount::factory()->create();

        $affordabilityExpenseReversalEvent->taxTypeCGST()->associate($taxTypeCGST);

        $this->assertArraysEqual($taxTypeCGST->toArray(), $affordabilityExpenseReversalEvent->taxTypeCGST->toArray());
    }

    /** @test */
    public function it_has_taxTypeSGST_relationship()
    {
        $affordabilityExpenseReversalEvent = AffordabilityExpenseReversalEvent::factory()->create();
        $taxTypeSGST = CurrencyAmount::factory()->create();

        $affordabilityExpenseReversalEvent->taxTypeSGST()->associate($taxTypeSGST);

        $this->assertArraysEqual($taxTypeSGST->toArray(), $affordabilityExpenseReversalEvent->taxTypeSGST->toArray());
    }
}

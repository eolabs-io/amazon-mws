<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class AffordabilityExpenseEventTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return AffordabilityExpenseEvent::class;
    }

    /** @test */
    public function it_has_baseExpense_relationship()
    {
        $affordabilityExpenseEvent = AffordabilityExpenseEvent::factory()->create(['base_expense_id' => null]);
        $baseExpense = CurrencyAmount::factory()->create();

        $affordabilityExpenseEvent->baseExpense()->associate($baseExpense);

        $this->assertArraysEqual($baseExpense->toArray(), $affordabilityExpenseEvent->baseExpense->toArray());
    }

    /** @test */
    public function it_has_totalExpense_relationship()
    {
        $affordabilityExpenseEvent = AffordabilityExpenseEvent::factory()->create(['total_expense_id' => null]);
        $totalExpense = CurrencyAmount::factory()->create();

        $affordabilityExpenseEvent->totalExpense()->associate($totalExpense);

        $this->assertArraysEqual($totalExpense->toArray(), $affordabilityExpenseEvent->totalExpense->toArray());
    }

    /** @test */
    public function it_has_taxTypeIGST_relationship()
    {
        $affordabilityExpenseEvent = AffordabilityExpenseEvent::factory()->create();
        $taxTypeIGST = CurrencyAmount::factory()->create();

        $affordabilityExpenseEvent->taxTypeIGST()->associate($taxTypeIGST);

        $this->assertArraysEqual($taxTypeIGST->toArray(), $affordabilityExpenseEvent->taxTypeIGST->toArray());
    }

    /** @test */
    public function it_has_taxTypeCGST_relationship()
    {
        $affordabilityExpenseEvent = AffordabilityExpenseEvent::factory()->create();
        $taxTypeCGST = CurrencyAmount::factory()->create();

        $affordabilityExpenseEvent->taxTypeCGST()->associate($taxTypeCGST);

        $this->assertArraysEqual($taxTypeCGST->toArray(), $affordabilityExpenseEvent->taxTypeCGST->toArray());
    }

    /** @test */
    public function it_has_taxTypeSGST_relationship()
    {
        $affordabilityExpenseEvent = AffordabilityExpenseEvent::factory()->create();
        $taxTypeSGST = CurrencyAmount::factory()->create();

        $affordabilityExpenseEvent->taxTypeSGST()->associate($taxTypeSGST);

        $this->assertArraysEqual($taxTypeSGST->toArray(), $affordabilityExpenseEvent->taxTypeSGST->toArray());
    }
}

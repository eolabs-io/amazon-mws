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
        $affordabilityExpenseEvent = factory(AffordabilityExpenseEvent::class)->create(['base_expense_id' => null]);
        $baseExpense = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseEvent->baseExpense()->associate($baseExpense);

        $this->assertArraysEqual($baseExpense->toArray(), $affordabilityExpenseEvent->baseExpense->toArray());
    }

    /** @test */
    public function it_has_totalExpense_relationship()
    {
        $affordabilityExpenseEvent = factory(AffordabilityExpenseEvent::class)->create(['total_expense_id' => null]);
        $totalExpense = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseEvent->totalExpense()->associate($totalExpense);

        $this->assertArraysEqual($totalExpense->toArray(), $affordabilityExpenseEvent->totalExpense->toArray());
    }

    /** @test */
    public function it_has_taxTypeIGST_relationship()
    {
        $affordabilityExpenseEvent = factory(AffordabilityExpenseEvent::class)->create();
        $taxTypeIGST = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseEvent->taxTypeIGST()->associate($taxTypeIGST);

        $this->assertArraysEqual($taxTypeIGST->toArray(), $affordabilityExpenseEvent->taxTypeIGST->toArray());
    }

    /** @test */
    public function it_has_taxTypeCGST_relationship()
    {
        $affordabilityExpenseEvent = factory(AffordabilityExpenseEvent::class)->create();
        $taxTypeCGST = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseEvent->taxTypeCGST()->associate($taxTypeCGST);

        $this->assertArraysEqual($taxTypeCGST->toArray(), $affordabilityExpenseEvent->taxTypeCGST->toArray());
    }

    /** @test */
    public function it_has_taxTypeSGST_relationship()
    {
        $affordabilityExpenseEvent = factory(AffordabilityExpenseEvent::class)->create();
        $taxTypeSGST = factory(CurrencyAmount::class)->create();

        $affordabilityExpenseEvent->taxTypeSGST()->associate($taxTypeSGST);

        $this->assertArraysEqual($taxTypeSGST->toArray(), $affordabilityExpenseEvent->taxTypeSGST->toArray());
    }
}

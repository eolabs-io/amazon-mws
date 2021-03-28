<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FinancialEventGroup;

class FinancialEventGroupTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return FinancialEventGroup::class;
    }

    /** @test */
    public function it_has_originalTotal_relationship()
    {
        $financialEventGroup = FinancialEventGroup::factory()->create(['original_total_id' => null]);
        $originalTotal = CurrencyAmount::factory()->create();

        $financialEventGroup->originalTotal()->associate($originalTotal);

        $this->assertArraysEqual($originalTotal->toArray(), $financialEventGroup->originalTotal->toArray());
    }

    /** @test */
    public function it_has_convertedTotal_relationship()
    {
        $financialEventGroup = FinancialEventGroup::factory()->create(['converted_total_id' => null]);
        $convertedTotal = CurrencyAmount::factory()->create();

        $financialEventGroup->convertedTotal()->associate($convertedTotal);

        $this->assertArraysEqual($convertedTotal->toArray(), $financialEventGroup->convertedTotal->toArray());
    }

    /** @test */
    public function it_has_beginningBalance_relationship()
    {
        $financialEventGroup = FinancialEventGroup::factory()->create(['beginning_balance_id' => null]);
        $beginningBalance = CurrencyAmount::factory()->create();

        $financialEventGroup->beginningBalance()->associate($beginningBalance);

        $this->assertArraysEqual($beginningBalance->toArray(), $financialEventGroup->beginningBalance->toArray());
    }
}

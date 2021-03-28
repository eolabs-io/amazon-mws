<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class FeeComponentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return FeeComponent::class;
    }

    /** @test */
    public function it_has_feeComponent_relationship()
    {
        $feeComponent = FeeComponent::factory()->create(['fee_amount_id' => null]);
        $feeAmount = CurrencyAmount::factory()->create();

        $feeComponent->feeAmount()->associate($feeAmount);

        $this->assertArraysEqual($feeAmount->toArray(), $feeComponent->feeAmount->toArray());
    }
}

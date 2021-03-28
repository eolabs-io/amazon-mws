<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\Promotion;

class PromotionTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Promotion::class;
    }

    /** @test */
    public function it_has_promotionAmount_relationship()
    {
        $promotion = Promotion::factory()->create(['promotion_amount_id' => null]);
        $promotionAmount = CurrencyAmount::factory()->create();

        $promotion->promotionAmount()->associate($promotionAmount);

        $this->assertArraysEqual($promotionAmount->toArray(), $promotion->promotionAmount->toArray());
    }
}

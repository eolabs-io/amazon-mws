<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\ProductAdsPaymentEvent;

class ProductAdsPaymentEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return ProductAdsPaymentEvent::class;
    }

    /** @test */
    public function it_has_baseValue_relationship()
    {
        $productAdsPaymentEvent = factory(ProductAdsPaymentEvent::class)->create(['base_value_id' => null]);
        $baseValue = factory(CurrencyAmount::class)->create();

        $productAdsPaymentEvent->baseValue()->associate($baseValue);

        $this->assertArraysEqual($baseValue->toArray(), $productAdsPaymentEvent->baseValue->toArray());
    }

    /** @test */
    public function it_has_taxValue_relationship()
    {
        $productAdsPaymentEvent = factory(ProductAdsPaymentEvent::class)->create(['tax_value_id' => null]);
        $taxValue = factory(CurrencyAmount::class)->create();

        $productAdsPaymentEvent->taxValue()->associate($taxValue);

        $this->assertArraysEqual($taxValue->toArray(), $productAdsPaymentEvent->taxValue->toArray());
    }

    /** @test */
    public function it_has_transactionValue_relationship()
    {
        $productAdsPaymentEvent = factory(ProductAdsPaymentEvent::class)->create(['transaction_value_id' => null]);
        $transactionValue = factory(CurrencyAmount::class)->create();

        $productAdsPaymentEvent->transactionValue()->associate($transactionValue);

        $this->assertArraysEqual($transactionValue->toArray(), $productAdsPaymentEvent->transactionValue->toArray());
    }

}
<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\NetworkComminglingTransactionEvent;

class NetworkComminglingTransactionEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return NetworkComminglingTransactionEvent::class;
    }

    /** @test */
    public function it_has_taxExclusiveAmount_relationship()
    {
        $networkComminglingTransactionEvent = factory(NetworkComminglingTransactionEvent::class)->create();
        $taxExclusiveAmount = factory(CurrencyAmount::class)->create();

        $networkComminglingTransactionEvent->taxExclusiveAmount()->associate($taxExclusiveAmount);

        $this->assertArraysEqual($taxExclusiveAmount->toArray(), $networkComminglingTransactionEvent->taxExclusiveAmount->toArray());
    }

    /** @test */
    public function it_has_taxAmount_relationship()
    {
        $networkComminglingTransactionEvent = factory(NetworkComminglingTransactionEvent::class)->create();
        $taxAmount = factory(CurrencyAmount::class)->create();

        $networkComminglingTransactionEvent->taxAmount()->associate($taxAmount);

        $this->assertArraysEqual($taxAmount->toArray(), $networkComminglingTransactionEvent->taxAmount->toArray());
    }

}

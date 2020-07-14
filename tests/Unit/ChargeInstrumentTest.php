<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeInstrument;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class ChargeInstrumentTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return ChargeInstrument::class;
    }

    /** @test */
    public function it_has_amount_relationship()
    {
        $chargeInstrument = factory(ChargeInstrument::class)->create(['amount_id' => null]);
        $amount = factory(CurrencyAmount::class)->create();

        $chargeInstrument->amount()->associate($amount);

        $this->assertArraysEqual($amount->toArray(), $chargeInstrument->amount->toArray());
    }

}

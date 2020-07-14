<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\RentalTransactionEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;

class RentalTransactionEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return RentalTransactionEvent::class;
    }

    /** @test */
    public function it_has_rentalChargeList_relationship()
    {
        $rentalTransactionEvent = factory(RentalTransactionEvent::class)->create();
        $rentalChargeList = factory(ChargeComponent::class, 3)->create();

        $rentalTransactionEvent->rentalChargeList()->toggle($rentalChargeList);

        $this->assertArraysEqual($rentalChargeList->toArray(), $rentalTransactionEvent->rentalChargeList->toArray());
    }

    /** @test */
    public function it_has_rentalFeeList_relationship()
    {
        $rentalTransactionEvent = factory(RentalTransactionEvent::class)->create();
        $rentalFeeList = factory(FeeComponent::class, 3)->create();

        $rentalTransactionEvent->rentalFeeList()->toggle($rentalFeeList);

        $this->assertArraysEqual($rentalFeeList->toArray(), $rentalTransactionEvent->rentalFeeList->toArray());
    }

    /** @test */
    public function it_has_rentalInitialValue_relationship()
    {
        $rentalTransactionEvent = factory(RentalTransactionEvent::class)->create(['rental_initial_value_id' => null]);
        $rentalInitialValue = factory(CurrencyAmount::class)->create();

        $rentalTransactionEvent->rentalInitialValue()->associate($rentalInitialValue);

        $this->assertArraysEqual($rentalInitialValue->toArray(), $rentalTransactionEvent->rentalInitialValue->toArray());
    }

    /** @test */
    public function it_has_rentalReimbursement_relationship()
    {
        $rentalTransactionEvent = factory(RentalTransactionEvent::class)->create(['rental_reimbursement_id' => null]);
        $rentalReimbursement = factory(CurrencyAmount::class)->create();

        $rentalTransactionEvent->rentalReimbursement()->associate($rentalReimbursement);

        $this->assertArraysEqual($rentalReimbursement->toArray(), $rentalTransactionEvent->rentalReimbursement->toArray());
    }

    /** @test */
    public function it_has_rentalTaxWithheldList_relationship()
    {
        $rentalTransactionEvent = factory(RentalTransactionEvent::class)->create();
        $rentalTaxWithheldList = factory(TaxWithheldComponent::class, 3)->create();

        $rentalTransactionEvent->rentalTaxWithheldList()->toggle($rentalTaxWithheldList);

        $this->assertArraysEqual($rentalTaxWithheldList->toArray(), $rentalTransactionEvent->rentalTaxWithheldList->toArray());
    }
}
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
        $rentalTransactionEvent = RentalTransactionEvent::factory()->create();
        $rentalChargeList = ChargeComponent::factory()->times(3)->create();

        $rentalTransactionEvent->rentalChargeList()->toggle($rentalChargeList);

        $this->assertArraysEqual($rentalChargeList->toArray(), $rentalTransactionEvent->rentalChargeList->toArray());
    }

    /** @test */
    public function it_has_rentalFeeList_relationship()
    {
        $rentalTransactionEvent = RentalTransactionEvent::factory()->create();
        $rentalFeeList = FeeComponent::factory()->times(3)->create();

        $rentalTransactionEvent->rentalFeeList()->toggle($rentalFeeList);

        $this->assertArraysEqual($rentalFeeList->toArray(), $rentalTransactionEvent->rentalFeeList->toArray());
    }

    /** @test */
    public function it_has_rentalInitialValue_relationship()
    {
        $rentalTransactionEvent = RentalTransactionEvent::factory()->create(['rental_initial_value_id' => null]);
        $rentalInitialValue = CurrencyAmount::factory()->create();

        $rentalTransactionEvent->rentalInitialValue()->associate($rentalInitialValue);

        $this->assertArraysEqual($rentalInitialValue->toArray(), $rentalTransactionEvent->rentalInitialValue->toArray());
    }

    /** @test */
    public function it_has_rentalReimbursement_relationship()
    {
        $rentalTransactionEvent = RentalTransactionEvent::factory()->create(['rental_reimbursement_id' => null]);
        $rentalReimbursement = CurrencyAmount::factory()->create();

        $rentalTransactionEvent->rentalReimbursement()->associate($rentalReimbursement);

        $this->assertArraysEqual($rentalReimbursement->toArray(), $rentalTransactionEvent->rentalReimbursement->toArray());
    }

    /** @test */
    public function it_has_rentalTaxWithheldList_relationship()
    {
        $rentalTransactionEvent = RentalTransactionEvent::factory()->create();
        $rentalTaxWithheldList = TaxWithheldComponent::factory()->times(3)->create();

        $rentalTransactionEvent->rentalTaxWithheldList()->toggle($rentalTaxWithheldList);

        $this->assertArraysEqual($rentalTaxWithheldList->toArray(), $rentalTransactionEvent->rentalTaxWithheldList->toArray());
    }
}

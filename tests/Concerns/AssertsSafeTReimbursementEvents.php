<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;


trait AssertsSafeTReimbursementEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent */
    public $safeTReimbursementEvent;

    public function assertSafeTReimbursementEventResponse()
    {
        $safeTReimbursementEvent = SafeTReimbursementEvent::where(["safe_t_claim_id" => "ADSIVMASDKFJ"])
                                             ->first();

        $this->assertSeesSafeTReimbursementEvent($safeTReimbursementEvent);
    }

    public function assertSeesSafeTReimbursementEvent($event)
    {
        $this->safeTReimbursementEvent = $event;

        $this->assertEquals($this->safeTReimbursementEvent->safe_t_claim_id, "ADSIVMASDKFJ");
        $this->assertEquals($this->safeTReimbursementEvent->reimbursedAmount->currency_amount, 5.67);

        $itemCharge = $this->safeTReimbursementEvent->safeTReimbursementItemList->first()
        											->itemChargeList->first()
        											->toArray();

		$this->assertEquals($itemCharge['charge_type'], "Discount");
		$this->assertEquals($itemCharge['charge_amount']['currency_amount'], 8.67);

        $this->safeTReimbursementEvent = null;
    }

}
<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent;


trait AssertsTDSReimbursementEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent */
    public $TDSReimbursementEvent;

    public function assertTDSReimbursementEventResponse()
    {
        $tdsReimbursementEvent = TDSReimbursementEvent::where(["tds_order_id" => "TDS-1235"])
                                             ->first();

        $this->assertSeesTDSReimbursementEvent($tdsReimbursementEvent);  
    }

    public function assertSeesTDSReimbursementEvent($event)
    {
        $this->tdsReimbursementEvent = $event;

        $this->assertEquals($this->tdsReimbursementEvent->reimbursedAmount->currency_amount, 3.98);

        $this->tdsReimbursementEvent = null;
    }

}
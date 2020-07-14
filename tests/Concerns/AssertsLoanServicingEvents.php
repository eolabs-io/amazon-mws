<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\LoanServicingEvent;


trait AssertsLoanServicingEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\LoanServicingEvent */
    public $loanServicingEvent;

    public function assertLoanServicingEventResponse()
    {
        $loanServicingEvent = LoanServicingEvent::first();

        $this->assertSeesLoanServicingEvent($loanServicingEvent);
    }

    public function assertSeesLoanServicingEvent($event)
    {
        $this->loanServicingEvent = $event;

        $this->assertEquals($this->loanServicingEvent->source_business_event_type, "LoanAdvance");
        $this->assertEquals($this->loanServicingEvent->loanAmount->currency_amount, 16.45);

        $this->loanServicingEvent = null;
    }

}
<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\ImagingServicesFeeEvent;


trait AssertsImagingServicesFeeEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ImagingServicesFeeEvent */
    public $imagingServicesFeeEvent;

    public function assertImagingServicesFeeEventResponse()
    {
        $imagingServicesFeeEvent = ImagingServicesFeeEvent::where(["imaging_request_billing_item_id" => "111-0457058-1007562"])
                                             ->first();

        $this->assertSeesImagingServicesFeeEvent($imagingServicesFeeEvent);
    }

    public function assertSeesImagingServicesFeeEvent($event)
    {
        $this->imagingServicesFeeEvent = $event;

        $this->assertEquals($this->imagingServicesFeeEvent->imaging_request_billing_item_id, "111-0457058-1007562");
        $this->assertEquals($this->imagingServicesFeeEvent->asin, "Bjdfsksdfjkfds");
        
        $feeList = $this->imagingServicesFeeEvent->feeList->load('feeAmount')->toArray();
        $this->assertEquals($feeList[0]['fee_amount']['currency_amount'], 6.38);

        $this->imagingServicesFeeEvent = null;
    }

}
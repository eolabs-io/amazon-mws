<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceFeeEvent;


trait AssertsServiceFeeEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ServiceFeeEvent */
    public $serviceFeeEvent;

    public function assertServiceFeeEventResponse()
    {
        $serviceFeeEvent = ServiceFeeEvent::where(["amazon_order_id" => "991-0457358-1247562"])
                                            ->first();

        $this->assertSeesServiceFeeEvent($serviceFeeEvent);
    }

    public function assertSeesServiceFeeEvent($event)
    {
        $this->serviceFeeEvent = $event;

        $this->assertEquals($this->serviceFeeEvent->amazon_order_id, "991-0457358-1247562");
        $this->assertEquals($this->serviceFeeEvent->fee_reason, "Fee Reason");
        $this->assertEquals($this->serviceFeeEvent->seller_sku, "SKJ-DFSAJKDS");
        $this->assertEquals($this->serviceFeeEvent->asin, "BTYFS63KSD");

        $feeList = $this->serviceFeeEvent->feeList->toArray();
        $this->assertEquals($feeList[0]['fee_type'], "ImagingServicesFee");
        $this->assertEquals($feeList[0]['fee_amount']['currency_amount'], 6.78);

        $this->serviceFeeEvent = null;
    }

}
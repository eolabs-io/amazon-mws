<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\ProductAdsPaymentEvent;


trait AssertsProductAdsPaymentEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ProductAdsPaymentEvent */
    public $productAdsPaymentEvent;

    public function assertProductAdsPaymentEventResponse()
    {
        $productAdsPaymentEvent = ProductAdsPaymentEvent::where(["invoice_Id" => "TR1W0B4YB-6"])
                                            ->first();

        $this->assertSeesProductAdsPaymentEvent($productAdsPaymentEvent);
    }

    public function assertSeesProductAdsPaymentEvent($event)
    {
        $this->productAdsPaymentEvent = $event;

        $this->assertEquals($this->productAdsPaymentEvent->transaction_type, "Charge");
      
        $this->assertEquals($this->productAdsPaymentEvent->baseValue->currency_amount, 115.34);
        $this->assertEquals($this->productAdsPaymentEvent->taxValue->currency_amount,  21.91);
        $this->assertEquals($this->productAdsPaymentEvent->transactionValue->currency_amount, 137.25);

        $this->productAdsPaymentEvent = null;
    }

}
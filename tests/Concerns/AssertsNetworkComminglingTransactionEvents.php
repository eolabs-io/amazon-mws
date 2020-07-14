<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\NetworkComminglingTransactionEvent;


trait AssertsNetworkComminglingTransactionEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\NetworkComminglingTransactionEvent */
    public $networkComminglingTransactionEvent;

    public function assertNetworkComminglingTransactionEventResponse()
    {
        $networkComminglingTransactionEvent = NetworkComminglingTransactionEvent::where(["net_co_transaction_id" => "1234567890"])
                                             ->first();

        $this->assertSeesNetworkComminglingTransactionEvent($networkComminglingTransactionEvent);  
    }

    public function assertSeesNetworkComminglingTransactionEvent($event)
    {
        $this->networkComminglingTransactionEvent = $event;

        $this->assertEquals($this->networkComminglingTransactionEvent->swap_reason, "Swap Reason");
        $this->assertEquals($this->networkComminglingTransactionEvent->transaction_type, "NetCo");
        $this->assertEquals($this->networkComminglingTransactionEvent->taxExclusiveAmount->currency_amount, 5.73);
        $this->assertEquals($this->networkComminglingTransactionEvent->taxAmount->currency_amount, 1.33);

        $this->networkComminglingTransactionEvent = null;
    }

}
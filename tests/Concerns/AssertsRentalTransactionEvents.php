<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\RentalTransactionEvent;


trait AssertsRentalTransactionEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent */
    public $rentalTransactionEvent;

    public function assertRentalTransactionEventResponse()
    {
        $rentalTransactionEvent = RentalTransactionEvent::where(["amazon_order_id" => "121-145158-7247662"])
                                            ->first();

        $this->assertSeesRentalTransactionEvent($rentalTransactionEvent);
    }

    public function assertSeesRentalTransactionEvent($event)
    {
        $this->rentalTransactionEvent = $event;

        $this->assertEquals($this->rentalTransactionEvent->amazon_order_id, "121-145158-7247662");
        $this->assertEquals($this->rentalTransactionEvent->rental_event_type, "RentalHandlingFee");
        $this->assertEquals($this->rentalTransactionEvent->extension_length, 5);
        $this->assertEquals($this->rentalTransactionEvent->marketplace_name, "eNameMarketplac");

        $this->rentalTransactionEvent = null;
    }

}
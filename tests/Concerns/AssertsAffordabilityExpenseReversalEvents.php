<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseReversalEvent;


trait AssertsAffordabilityExpenseReversalEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseReversalEvent */
    public $affordabilityExpenseReversalEvent;

    public function assertAffordabilityExpenseReversalEventResponse()
    {
          $affordabilityExpenseReversalEvent = AffordabilityExpenseReversalEvent::where(["amazon_order_id" => "931-2463294-5740665"])
                                             ->first();

        $this->assertSeesAffordabilityExpenseReversalEvent($affordabilityExpenseReversalEvent);  
    }

    public function assertSeesAffordabilityExpenseReversalEvent($event)
    {
        $this->affordabilityExpenseReversalEvent = $event;

        $this->assertEquals($this->affordabilityExpenseReversalEvent->transaction_type, "Refund");
        $this->assertEquals($this->affordabilityExpenseReversalEvent->marketplace_id, "A2XZLSVIQ0F4JT");

        $this->assertEquals($this->affordabilityExpenseReversalEvent->baseExpense->currency_amount, 100.0);
		$this->assertEquals($this->affordabilityExpenseReversalEvent->totalExpense->currency_amount, 118.0);
		$this->assertEquals($this->affordabilityExpenseReversalEvent->taxTypeIGST->currency_amount, 18.0);
		$this->assertEquals($this->affordabilityExpenseReversalEvent->taxTypeCGST->currency_amount, 0.0);
		$this->assertEquals($this->affordabilityExpenseReversalEvent->taxTypeSGST->currency_amount, 0.0);

        $this->affordabilityExpenseReversalEvent = null;
    }

}


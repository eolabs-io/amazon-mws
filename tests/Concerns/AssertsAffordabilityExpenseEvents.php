<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseEvent;


trait AssertsAffordabilityExpenseEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseEvent */
    public $affordabilityExpenseEvent;

    public function assertAffordabilityExpenseEventResponse()
    {
          $affordabilityExpenseEvent = AffordabilityExpenseEvent::where(["amazon_order_id" => "931-2463294-5740665"])
                                             ->first();

        $this->assertSeesAffordabilityExpenseEvent($affordabilityExpenseEvent);  
    }

    public function assertSeesAffordabilityExpenseEvent($event)
    {
        $this->affordabilityExpenseEvent = $event;

        $this->assertEquals($this->affordabilityExpenseEvent->transaction_type, "Charge");
        $this->assertEquals($this->affordabilityExpenseEvent->marketplace_id, "A2XZLSVIQ0F4JT");

        $this->assertEquals($this->affordabilityExpenseEvent->baseExpense->currency_amount, -100.0);
		$this->assertEquals($this->affordabilityExpenseEvent->totalExpense->currency_amount, -118.0);
		$this->assertEquals($this->affordabilityExpenseEvent->taxTypeIGST->currency_amount, -18.0);
		$this->assertEquals($this->affordabilityExpenseEvent->taxTypeCGST->currency_amount, 0.0);
		$this->assertEquals($this->affordabilityExpenseEvent->taxTypeSGST->currency_amount, 0.0);

        $this->affordabilityExpenseEvent = null;
    }

}


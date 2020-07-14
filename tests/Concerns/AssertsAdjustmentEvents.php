<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;


trait AssertsAdjustmentEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent */
    public $adjustmentEvent;

    public function assertAdjustmentEventResponse()
    {
        $adjustmentEvent = AdjustmentEvent::first();

        $this->assertSeesAdjustmentEvent($adjustmentEvent);
    }

    public function assertSeesAdjustmentEvent($event)
    {
        $this->adjustmentEvent = $event;

        $this->assertEquals($this->adjustmentEvent->adjustment_type, "ReserveEvent");
        $this->assertEquals($this->adjustmentEvent->adjustmentAmount->currency_amount, 16.45);

        $this->adjustmentEvent = null;
    }

}
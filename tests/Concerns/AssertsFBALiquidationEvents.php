<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\FBALiquidationEvent;


trait AssertsFBALiquidationEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\assertSeesFBALiquidationEvent */
    public $fbaLiquidationEvent;

    public function assertFBALiquidationEventResponse()
    {
        $fbaLiquidationEvent = FBALiquidationEvent::where(["original_removal_order_id" => "111-0457058-1007562"])
                                             ->first();

        $this->assertSeesFBALiquidationEvent($fbaLiquidationEvent);
    }

    public function assertSeesFBALiquidationEvent($event)
    {
        $this->fbaLiquidationEvent = $event;

        $this->assertEquals($this->fbaLiquidationEvent->original_removal_order_id, "111-0457058-1007562");  
        $this->assertEquals($this->fbaLiquidationEvent->liquidationProceedsAmount->currency_amount, 1.09);
        $this->assertEquals($this->fbaLiquidationEvent->liquidationFeeAmount->currency_amount, 1.09);

        $this->fbaLiquidationEvent = null;
    }

}
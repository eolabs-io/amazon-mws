<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\FBALiquidationEvent;

class PersistedFBALiquidationEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\FBALiquidationEvent */
    public $fbaLiquidationEvent;

    public function __construct(FBALiquidationEvent $fbaLiquidationEvent)
    {
        $this->fbaLiquidationEvent = $fbaLiquidationEvent;
    }
}

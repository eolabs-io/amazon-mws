<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseEvent;

class PersistedAffordabilityExpenseEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseEvent */
    public $affordabilityExpenseEvent;

    public function __construct(AffordabilityExpenseEvent $affordabilityExpenseEvent)
    {
        $this->affordabilityExpenseEvent = $affordabilityExpenseEvent;
    }
}

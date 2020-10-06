<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseReversalEvent;

class PersistedAffordabilityExpenseReversalEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseReversalEvent */
    public $affordabilityExpenseReversalEvent;

    public function __construct(AffordabilityExpenseReversalEvent $affordabilityExpenseReversalEvent)
    {
        $this->affordabilityExpenseReversalEvent = $affordabilityExpenseReversalEvent;
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;

class PersistedSAFETReimbursementEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent */
    public $safeTReimbursementEvent;

    public function __construct(SafeTReimbursementEvent $safeTReimbursementEvent)
    {
        $this->safeTReimbursementEvent = $safeTReimbursementEvent;
    }
}

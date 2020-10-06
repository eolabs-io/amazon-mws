<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent;

class PersistedTDSReimbursementEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent */
    public $tdsReimbursementEvent;

    public function __construct(TDSReimbursementEvent $tdsReimbursementEvent)
    {
        $this->tdsReimbursementEvent = $tdsReimbursementEvent;
    }
}

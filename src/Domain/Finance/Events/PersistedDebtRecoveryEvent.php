<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryEvent;

class PersistedDebtRecoveryEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryEvent */
    public $debtRecoveryEvent;

    public function __construct(DebtRecoveryEvent $debtRecoveryEvent)
    {
        $this->debtRecoveryEvent = $debtRecoveryEvent;
    }
}

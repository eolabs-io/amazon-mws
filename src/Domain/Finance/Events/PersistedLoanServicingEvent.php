<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\LoanServicingEvent;

class PersistedLoanServicingEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\LoanServicingEvent */
    public $loanServicingEvent;

    public function __construct(LoanServicingEvent $loanServicingEvent)
    {
        $this->loanServicingEvent = $loanServicingEvent;
    }
}

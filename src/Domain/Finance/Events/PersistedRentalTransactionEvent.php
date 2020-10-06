<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\RentalTransactionEvent;

class PersistedRentalTransactionEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\RentalTransactionEvent */
    public $rentalTransactionEvent;

    public function __construct(RentalTransactionEvent $rentalTransactionEvent)
    {
        $this->rentalTransactionEvent = $rentalTransactionEvent;
    }
}

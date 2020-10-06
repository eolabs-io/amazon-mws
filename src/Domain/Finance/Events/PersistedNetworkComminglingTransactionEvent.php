<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\NetworkComminglingTransactionEvent;

class PersistedNetworkComminglingTransactionEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\NetworkComminglingTransactionEvent */
    public $networkComminglingTransactionEvent;

    public function __construct(NetworkComminglingTransactionEvent $networkComminglingTransactionEvent)
    {
        $this->networkComminglingTransactionEvent = $networkComminglingTransactionEvent;
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\GuaranteeClaimEvent;

class PersistedGuaranteeClaimEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\GuaranteeClaimEvent */
    public $guaranteeClaimEvent;

    public function __construct(GuaranteeClaimEvent $guaranteeClaimEvent)
    {
        $this->guaranteeClaimEvent = $guaranteeClaimEvent;
    }
}

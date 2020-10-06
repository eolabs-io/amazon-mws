<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceProviderCreditEvent;

class PersistedServiceProviderCreditEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ServiceProviderCreditEvent */
    public $serviceProviderCreditEvent;

    public function __construct(ServiceProviderCreditEvent $serviceProviderCreditEvent)
    {
        $this->serviceProviderCreditEvent = $serviceProviderCreditEvent;
    }
}

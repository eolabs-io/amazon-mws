<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent;

class PersistedPayWithAmazonEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent */
    public $payWithAmazonEvent;

    public function __construct(PayWithAmazonEvent $payWithAmazonEvent)
    {
        $this->payWithAmazonEvent = $payWithAmazonEvent;
    }
}

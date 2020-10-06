<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Finance\Models\ImagingServicesFeeEvent;

class PersistedImagingServicesFeeEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ImagingServicesFeeEvent */
    public $imagingServicesFeeEvent;

    public function __construct(ImagingServicesFeeEvent $imagingServicesFeeEvent)
    {
        $this->imagingServicesFeeEvent = $imagingServicesFeeEvent;
    }
}

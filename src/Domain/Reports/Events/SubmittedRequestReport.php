<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reports\RequestReport;

class SubmittedRequestReport
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reports\RequestReport */
    public $requestReport;

    public function __construct(RequestReport $requestReport)
    {
        $this->requestReport = $requestReport;
    }
}

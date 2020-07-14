<?php
 
namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use EolabsIo\AmazonMws\Domain\Finance\ListFinancialEvents;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class FetchListFinancialEvents
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\ListFinancialEvents */
    public $listFinancialEvents;

    public function __construct(ListFinancialEvents $listFinancialEvents)
    {
        $this->listFinancialEvents = $listFinancialEvents;
    }
}
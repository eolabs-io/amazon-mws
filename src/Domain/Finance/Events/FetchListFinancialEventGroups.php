<?php
 
namespace EolabsIo\AmazonMws\Domain\Finance\Events;

use EolabsIo\AmazonMws\Domain\Finance\ListFinancialEventGroups;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class FetchListFinancialEventGroups
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\ListFinancialEventGroups */
    public $listFinancialEventGroups;

    public function __construct(ListFinancialEventGroups $listFinancialEventGroups)
    {
        $this->listFinancialEventGroups = $listFinancialEventGroups;
    }
}
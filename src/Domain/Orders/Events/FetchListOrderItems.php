<?php
 
namespace EolabsIo\AmazonMws\Domain\Orders\Events;

use EolabsIo\AmazonMws\Domain\Orders\ListOrderItems;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class FetchListOrderItems
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Orders\ListOrderItems */
    public $listOrderItems;

    public function __construct(ListOrderItems $listOrderItems)
    {
        $this->listOrderItems = $listOrderItems;
    }
}
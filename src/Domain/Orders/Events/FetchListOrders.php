<?php
 
namespace EolabsIo\AmazonMws\Domain\Orders\Events;

use EolabsIo\AmazonMws\Domain\Orders\ListOrders;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class FetchListOrders
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Orders\ListOrders */
    public $listOrders;

    public function __construct(ListOrders $listOrders)
    {
        $this->listOrders = $listOrders;
    }
}
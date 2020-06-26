<?php
 
namespace EolabsIo\AmazonMws\Domain\Orders\Events;

use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class OrderWasUpdated
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Orders\Models\Order */
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
<?php

namespace EolabsIo\AmazonMws\Domain\Inventory\Events;

use EolabsIo\AmazonMws\Domain\Inventory\InventoryList;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class FetchInventoryList
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Inventory\InventoryList */
    public $inventoryList;

    public function __construct(InventoryList $inventoryList)
    {
        $this->inventoryList = $inventoryList;
    }
}
<?php

namespace EolabsIo\AmazonMws\Domain\Inventory;

use EolabsIo\AmazonMws\Domain\Shared\AmazonCore;


abstract class InventoryCore extends AmazonCore
{

    public function getBranchUrl(): string
    {
    	return "FulfillmentInventory/". $this->getVersion();
    }

 	public function getTypeAccessor(): string
 	{
 		return 'Inventory';
 	}

	public function getAction(): string
	{
		return ($this->hasNextToken()) ? 'ListInventorySupplyByNextToken' : 'ListInventorySupply';
	}

}
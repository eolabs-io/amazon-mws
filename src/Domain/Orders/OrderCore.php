<?php

namespace EolabsIo\AmazonMws\Domain\Orders;

use EolabsIo\AmazonMws\Domain\Shared\AmazonCore;


abstract class OrderCore extends AmazonCore
{

    public function getBranchUrl(): string
    {
    	return "Orders/". $this->getVersion();
    }

 	public function getTypeAccessor(): string
 	{
 		return 'Orders';
 	}

	public function getAction(): string
	{
		return ($this->hasNextToken()) ? 'ListOrdersByNextToken' : 'ListOrders';
	}

}
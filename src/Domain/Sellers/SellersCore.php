<?php

namespace EolabsIo\AmazonMws\Domain\Sellers;

use EolabsIo\AmazonMws\Domain\Shared\AmazonCore;


abstract class SellersCore extends AmazonCore
{

    public function getBranchUrl(): string
    {
    	return "Sellers/". $this->getVersion();
    }

 	public function getTypeAccessor(): string
 	{
 		return 'Sellers';
 	}

}
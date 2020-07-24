<?php

namespace EolabsIo\AmazonMws\Domain\Products;

use EolabsIo\AmazonMws\Domain\Shared\AmazonCore;


abstract class ProductCore extends AmazonCore
{

    public function getBranchUrl(): string
    {
    	return "Products/". $this->getVersion();
    }

 	public function getTypeAccessor(): string
 	{
 		return 'Products';
 	}

}
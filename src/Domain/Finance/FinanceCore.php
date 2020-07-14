<?php

namespace EolabsIo\AmazonMws\Domain\Finance;

use EolabsIo\AmazonMws\Domain\Shared\AmazonCore;


abstract class FinanceCore extends AmazonCore
{

    public function getBranchUrl(): string
    {
    	return "Finances/". $this->getVersion();
    }

 	public function getTypeAccessor(): string
 	{
 		return 'Finances';
 	}

}
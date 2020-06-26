<?php

namespace EolabsIo\AmazonMws\Domain\Orders;

use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithAmazonOrderId;
use EolabsIo\AmazonMws\Domain\Orders\OrderCore;

class ListOrderItems extends OrderCore
{
	use InteractsWithAmazonOrderId;


	public function resolveOptionalParameters(): void
	{
		$this->mergeParameters( [$this->getAmazonOrderIdParameter()] );
	}

	public function getAction(): string
	{
		return ($this->hasNextToken()) ? 'ListOrderItemsByNextToken' : 'ListOrderItems';
	}
}

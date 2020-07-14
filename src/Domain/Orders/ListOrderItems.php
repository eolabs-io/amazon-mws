<?php

namespace EolabsIo\AmazonMws\Domain\Orders;

use EolabsIo\AmazonMws\Domain\Orders\OrderCore;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\InteractsWithAmazonOrderId;

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

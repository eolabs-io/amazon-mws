<?php

namespace EolabsIo\AmazonMws\Domain\Inventory;

use EolabsIo\AmazonMws\Domain\Inventory\InventoryCore;


class ServiceStatus extends InventoryCore
{

	public function getAction(): string
	{
		return 'GetServiceStatus';
	}

	public function resolveOptionalParameters(): void
	{

	}

}
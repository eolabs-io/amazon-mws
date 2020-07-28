<?php

namespace EolabsIo\AmazonMws\Domain\Sellers;


class ListMarketplaceParticipations extends SellersCore
{

	public function getAction(): string
	{
		return ($this->hasNextToken()) ? 'ListMarketplaceParticipationsByNextToken' 
									   : 'ListMarketplaceParticipations';
	}

	public function resolveOptionalParameters(): void
	{

	}

}

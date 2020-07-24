<?php

namespace EolabsIo\AmazonMws\Domain\Products;

use EolabsIo\AmazonMwsResponseParser\Support\Facades\AmazonMwsResponseParser;
use EolabsIo\AmazonMws\Domain\Products\Concerns\InteractsASINList;
use EolabsIo\AmazonMws\Domain\Products\Concerns\InteractsWithMarketplaceId;
use Illuminate\Http\Client\Response;


class GetMatchingProduct extends ProductCore
{
	use InteractsWithMarketplaceId,
		InteractsASINList;


	public function resolveOptionalParameters(): void
	{
		$this->mergeParameters( [$this->getMarketplaceIdParameter(),
								 $this->getASINListParameter(),	
							 ]);
	}

	public function getAction(): string
	{
		return 'GetMatchingProduct';
	}

}

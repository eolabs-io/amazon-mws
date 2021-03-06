<?php

namespace EolabsIo\AmazonMws\Domain\Products;

use EolabsIo\AmazonMws\Domain\Products\Concerns\InteractsWithASINList;
use EolabsIo\AmazonMws\Domain\Products\Concerns\InteractsWithMarketplaceId;

class GetMatchingProduct extends ProductCore
{
    use InteractsWithMarketplaceId,
        InteractsWithASINList;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([$this->getMarketplaceIdParameter(),
                                 $this->getASINListParameter(),
                             ]);
    }

    public function getAction(): string
    {
        return 'GetMatchingProduct';
    }
}

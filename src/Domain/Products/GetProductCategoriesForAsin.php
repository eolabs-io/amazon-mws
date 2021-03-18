<?php

namespace EolabsIo\AmazonMws\Domain\Products;

use EolabsIo\AmazonMws\Domain\Products\Concerns\InteractsWithASIN;
use EolabsIo\AmazonMws\Domain\Products\Concerns\InteractsWithMarketplaceId;

class GetProductCategoriesForAsin extends ProductCore
{
    use InteractsWithMarketplaceId,
        InteractsWithASIN;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([$this->getMarketplaceIdParameter(),
                                 $this->getASINParameter(),
                             ]);
    }

    public function getAction(): string
    {
        return 'GetProductCategoriesForASIN';
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Products;

use EolabsIo\AmazonMws\Domain\Products\Concerns\InteractsWithSKU;
use EolabsIo\AmazonMws\Domain\Products\Concerns\InteractsWithMarketplaceId;

class GetProductCategoriesForSku extends ProductCore
{
    use InteractsWithMarketplaceId,
        InteractsWithSKU;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([$this->getMarketplaceIdParameter(),
                                 $this->getSkuParameter(),
                             ]);
    }

    public function getAction(): string
    {
        return 'GetProductCategoriesForSKU';
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Products\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Products\GetProductCategoriesForSku;

class FetchGetProductCategoriesForSku
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Products\GetProductCategoriesForSku */
    public $getProductCategoriesForSku;

    public function __construct(GetProductCategoriesForSku $getProductCategoriesForSku)
    {
        $this->getProductCategoriesForSku = $getProductCategoriesForSku;
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Products\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Products\GetProductCategoriesForAsin;

class FetchGetProductCategoriesForAsin
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Products\GetProductCategoriesForAsin */
    public $getProductCategoriesForAsin;

    public function __construct(GetProductCategoriesForAsin $getProductCategoriesForAsin)
    {
        $this->getProductCategoriesForAsin = $getProductCategoriesForAsin;
    }
}

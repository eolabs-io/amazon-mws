<?php
 
namespace EolabsIo\AmazonMws\Domain\Products\Events;

use EolabsIo\AmazonMws\Domain\Products\GetMatchingProduct;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class FetchGetMatchingProduct
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Products\GetMatchingProduct */
    public $getMatchingProduct;

    public function __construct(GetMatchingProduct $getMatchingProduct)
    {
        $this->getMatchingProduct = $getMatchingProduct;
    }
}
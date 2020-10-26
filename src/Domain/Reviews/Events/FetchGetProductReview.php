<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reviews\GetProductReview;

class FetchGetProductReview
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reviews\GetProductReview */
    public $getProductReview;

    public function __construct(GetProductReview $getProductReview)
    {
        $this->getProductReview = $getProductReview;
    }
}

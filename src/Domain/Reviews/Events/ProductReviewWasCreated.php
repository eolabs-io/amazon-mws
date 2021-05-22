<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;

class ProductReviewWasCreated
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview */
    public $review;

    public function __construct(ProductReview $review)
    {
        $this->review = $review;
    }
}

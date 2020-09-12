<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating;

class FetchGetReviewRating
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating */
    public $getReviewRating;

    public function __construct(GetReviewRating $getReviewRating)
    {
        $this->getReviewRating = $getReviewRating;
    }
}

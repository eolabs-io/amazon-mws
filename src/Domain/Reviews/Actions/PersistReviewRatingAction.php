<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Actions;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ReviewRatingHistory;

class PersistReviewRatingAction
{
    /** @var array */
    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function execute()
    {
        ReviewRatingHistory::create([
            'asin' => $this->item['asin'],
            'ratings' => $this->item['ratings'],
            'average_stars_rating' => $this->item['averageStarsRating'],
        ]);
    }
}

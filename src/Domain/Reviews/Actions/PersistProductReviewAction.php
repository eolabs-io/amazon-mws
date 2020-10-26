<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Actions;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;

class PersistProductReviewAction
{
    /** @var array */
    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function execute()
    {
        $asin = data_get($this->item, 'asin');
        $reviews = data_get($this->item, 'reviews', []);

        foreach ($reviews as $review) {
            $review['asin'] = $asin;
            $attributes = ['reviewId' => data_get($review, 'reviewId')];

            ProductReview::updateOrCreate($attributes, $review);
            // need to associate images
        }
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Actions;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewImage;

class SaveProductReviewImageAction
{
    /** @var array */
    private $list;

    public function __construct($list)
    {
        $this->list = $list;
    }

    public function execute(ProductReview $productReview)
    {
        $images = data_get($this->list, 'images', []);

        foreach ($images as $image) {
            $attributes = [
                'product_review_id' => $productReview->id,
                'url' => $image,
            ];
            $review = $attributes;

            ProductReviewImage::updateOrCreate($attributes, $review);
        }
    }
}

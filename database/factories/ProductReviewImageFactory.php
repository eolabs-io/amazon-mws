<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewImage;

$factory->define(ProductReviewImage::class, function (Faker $faker) {
    return [
            'product_review_id' => function () {
                return factory(ProductReview::class)->create()->id;
            },
            'url' => $faker->url(),
    ];
});

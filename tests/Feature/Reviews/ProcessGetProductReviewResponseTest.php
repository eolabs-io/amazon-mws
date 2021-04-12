<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Carbon;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\AmazonMws\Support\Facades\GetProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\ProcessGetProductReviewResponse;

class ProcessGetProductReviewResponseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        GetProductReview::fake([
            'type' => '__WithImages__',
        ]);

        $getProductReview = GetProductReview::withAsin('B00200000Q');
        $results = $getProductReview->fetch();
        $results['asin'] = $getProductReview->getAsin();

        (new ProcessGetProductReviewResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_product_reviews_response()
    {
        $review = ProductReview::first();

        $this->assertEquals('B00200000Q', $review->asin);
        $this->assertEquals('R3AEH6GOU3Q3A4', $review->reviewId);
        $this->assertEquals('Amazon Customer', $review->profileName);
        $this->assertEquals(5.0, $review->starRating);
        $this->assertEquals('Great Product', $review->title);
        $this->assertEquals(new Carbon('Oct 24, 2020'), $review->date);

        $this->assertDatabaseCount('product_reviews', 8);
    }

    /** @test */
    public function it_has_product_review_images_response()
    {
        $review = ProductReview::where('reviewId', 'RNKKMVAMV3QSN')->first();

        $this->assertCount(3, $review->images);
    }
}

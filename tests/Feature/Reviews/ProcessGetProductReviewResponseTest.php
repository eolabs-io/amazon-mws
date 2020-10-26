<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesGetProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\ProcessGetProductReviewResponse;

class ProcessGetProductReviewResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesGetProductReview;

    protected function setUp(): void
    {
        parent::setUp();

        $getProductReview = $this->createGetProductReview();

        $results = $getProductReview->fetch();
        $results['asin'] = $getProductReview->getAsin();

        (new ProcessGetProductReviewResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_product_reviews_response()
    {
        $review = ProductReview::first();

        $this->assertEquals('B00200000Q', $review->asin);
        $this->assertEquals('R3DK9D3YPXLMRD', $review->reviewId);
        $this->assertEquals('Thomas', $review->profileName);
        $this->assertEquals(5.0, $review->starRating);
        $this->assertEquals('It works!', $review->title);

        $this->assertDatabaseCount('product_reviews', 10);
    }
}

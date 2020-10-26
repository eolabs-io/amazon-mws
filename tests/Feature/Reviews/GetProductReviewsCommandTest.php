<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetProductReview;

class GetProductReviewsCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_get_reviews_artisan_command()
    {
        $this->artisan('amazonmws:get-product-reviews
                            --marketplace-ids=ATVPDKIKX0DER
                            --asins=B123456789
                            --asins=B987654321
                    ')
                    ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchGetProductReview::class, function ($event) {
            $getProductReview = $event->getProductReview;
            return $getProductReview->getAsin() === 'B987654321';
        });

        Event::assertDispatched(FetchGetProductReview::class, function ($event) {
            $getProductReview = $event->getProductReview;
            return $getProductReview->getAsin() === 'B123456789';
        });

        Event::assertDispatchedTimes(FetchGetProductReview::class, 2);
    }

    /** @test */
    public function it_can_execute_product_review_with_marketplace_lookup_artisan_command()
    {
        factory(Product::class)->create(['marketplace_id' => 'ATVPDKIKX0DER', 'asin' => 'B123456789']);
        factory(Product::class)->create(['marketplace_id' => 'ATVPDKIKX0DER', 'asin' => 'B987654321']);
        factory(Product::class)->create(['marketplace_id' => 'XXXPDKIKX0XXX', 'asin' => 'B111111111']);

        $this->artisan('amazonmws:get-product-reviews
                             --marketplace-ids=ATVPDKIKX0DER
                     ')
                     ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchGetProductReview::class, function ($event) {
            $getProductReview = $event->getProductReview;
            return $getProductReview->getAsin() === 'B987654321';
        });

        Event::assertDispatched(FetchGetProductReview::class, function ($event) {
            $getProductReview = $event->getProductReview;
            return $getProductReview->getAsin() === 'B123456789';
        });

        Event::assertDispatchedTimes(FetchGetProductReview::class, 2);
    }
}

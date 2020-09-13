<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Reviews;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetReviewRating;

class LogReviewRatingCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_log_review_rating_artisan_command()
    {
        $this->artisan('amazonmws:log-review-ratings
                            --marketplace-ids=ATVPDKIKX0DER
                            --asins=B123456789
                            --asins=B987654321
                    ')
                    ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchGetReviewRating::class, function ($event) {
            $getReviewRating = $event->getReviewRating;
            return $getReviewRating->getAsin() === 'B987654321';
        });

        Event::assertDispatched(FetchGetReviewRating::class, function ($event) {
            $getReviewRating = $event->getReviewRating;
            return $getReviewRating->getAsin() === 'B123456789';
        });

        Event::assertDispatchedTimes(FetchGetReviewRating::class, 2);
    }

    /** @test */
    public function it_can_execute_log_review_rating_with_marketplace_lookup_artisan_command()
    {
        factory(Product::class)->create(['marketplace_id' => 'ATVPDKIKX0DER', 'asin' => 'B123456789']);
        factory(Product::class)->create(['marketplace_id' => 'ATVPDKIKX0DER', 'asin' => 'B987654321']);
        factory(Product::class)->create(['marketplace_id' => 'XXXPDKIKX0XXX', 'asin' => 'B111111111']);

        $this->artisan('amazonmws:log-review-ratings
                             --marketplace-ids=ATVPDKIKX0DER
                     ')
                     ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchGetReviewRating::class, function ($event) {
            $getReviewRating = $event->getReviewRating;
            return $getReviewRating->getAsin() === 'B987654321';
        });

        Event::assertDispatched(FetchGetReviewRating::class, function ($event) {
            $getReviewRating = $event->getReviewRating;
            return $getReviewRating->getAsin() === 'B123456789';
        });

        Event::assertDispatchedTimes(FetchGetReviewRating::class, 2);
    }
}

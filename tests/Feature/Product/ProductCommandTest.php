<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Product;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetMatchingProduct;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

class ProductCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_product_artisan_command()
    {
        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:product '.$store->id.'
                                                --marketplace-id=ATVPDKIKX0DER
                                                --asin=B123456789
                    ')
                    ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchGetMatchingProduct::class, function ($event) {
            $getMatchingProduct = $event->getMatchingProduct;

            return $getMatchingProduct->getMarketplaceId() === 'ATVPDKIKX0DER' &&
                   in_array('B123456789', $getMatchingProduct->getAsins());
        });
    }
}

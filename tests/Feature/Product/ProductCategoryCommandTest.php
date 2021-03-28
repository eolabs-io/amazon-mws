<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Product;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\AmazonMws\Tests\TestCase;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetProductCategoriesForSku;
use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetProductCategoriesForAsin;

class ProductCategoryCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_product_category_for_asin_artisan_command()
    {
        $store = Store::factory()->create();

        $this->artisan('amazonmws:product-category '.$store->id.'
                                                --marketplace-id=ATVPDKIKX0DER
                                                --asin=B123456789
                    ')
                    ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchGetProductCategoriesForAsin::class, function ($event) {
            $getProductCategoriesForAsin = $event->getProductCategoriesForAsin;

            return $getProductCategoriesForAsin->getMarketplaceId() === 'ATVPDKIKX0DER' &&
                   $getProductCategoriesForAsin->getAsin() === 'B123456789';
        });
    }

    /** @test */
    public function it_can_execute_product_category_for_sku_artisan_command()
    {
        $store = Store::factory()->create();

        $this->artisan('amazonmws:product-category '.$store->id.'
                                                    --marketplace-id=ATVPDKIKX0DER
                                                    --sku=SKU-123-456789
                        ')
                        ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchGetProductCategoriesForSku::class, function ($event) {
            $getProductCategoriesForSku = $event->getProductCategoriesForSku;

            return $getProductCategoriesForSku->getMarketplaceId() === 'ATVPDKIKX0DER' &&
                   $getProductCategoriesForSku->getSku() === 'SKU-123-456789';
        });
    }
}

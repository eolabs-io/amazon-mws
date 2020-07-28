<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Inventory;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Sellers\Events\FetchListMarketplaceParticipations;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

class SellerCommandTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_seller_artisan_command()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:seller '.$store->id.' ')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListMarketplaceParticipations::class);

    }

}
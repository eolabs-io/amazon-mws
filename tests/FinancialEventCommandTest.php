<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEvents;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

class FinancialEventCommandTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    /** @test */
    public function it_can_execute_financial_event_group_with_max_results_per_page_artisan_command()
    {
        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:financial-event '.$store->id.' --max-results-per-page=20')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListFinancialEvents::class, function($event){
            $listFinancialEvents = $event->listFinancialEvents;

            return $listFinancialEvents->getMaxResultsPerPage() === 20;
        });
    }

    /** @test */
    public function it_can_execute_financial_event_group_with_amazon_order_id_artisan_command()
    {
        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:financial-event '.$store->id.' --amazon-order-id=111-1234567-1234567')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListFinancialEvents::class, function($event){
            $listFinancialEvents = $event->listFinancialEvents;

            return $listFinancialEvents->getAmazonOrderId() === '111-1234567-1234567';
        });
    }

    /** @test */
    public function it_can_execute_financial_event_group_with_financial_event_group_id_artisan_command()
    {
        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:financial-event '.$store->id.' --financial-event-group-id=11112345671234567')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListFinancialEvents::class, function($event){
            $listFinancialEvents = $event->listFinancialEvents;

            return $listFinancialEvents->getFinancialEventGroupId() === '11112345671234567';
        });
    }

    /** @test */
    public function it_can_execute_financial_event_posted_after_artisan_command()
    {
        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:financial-event '.$store->id.' --posted-after=2020-06-27T14:10:00.000-06:00')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListFinancialEvents::class, function($event){
            $listFinancialEvents = $event->listFinancialEvents;

            return $listFinancialEvents->getPostedAfter() === '2020-06-27T20:10:00Z';
        });
    }

    /** @test */
    public function it_can_execute_financial_event_posted_before_artisan_command()
    {
        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:financial-event '.$store->id.' --posted-before=2020-06-27T14:10:00.000-06:00')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListFinancialEvents::class, function($event){
            $listFinancialEvents = $event->listFinancialEvents;

            return $listFinancialEvents->getPostedBefore() === '2020-06-27T20:10:00Z';
        });
    }
}
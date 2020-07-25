<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Financial;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEventGroups;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

class FinancialEventGroupCommandTest extends TestCase
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

        $this->artisan('amazonmws:financial-event-group '.$store->id.' --max-results-per-page=20')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListFinancialEventGroups::class, function($event){
            $listFinancialEventGroups = $event->listFinancialEventGroups;

            return $listFinancialEventGroups->getMaxResultsPerPage() === 20;
        });
    }

    /** @test */
    public function it_can_execute_financial_event_group_with_started_after_artisan_command()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:financial-event-group '.$store->id.' --started-after=2020-06-27T14:10:00.000-06:00')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListFinancialEventGroups::class, function($event){
            $listFinancialEventGroups = $event->listFinancialEventGroups;

            return $listFinancialEventGroups->getFinancialEventGroupStartedAfter() === '2020-06-27T20:10:00Z';
        });
    }

    /** @test */
    public function it_can_execute_financial_event_group_with_started_before_artisan_command()
    {

        $store = factory(Store::class)->create();

        $this->artisan('amazonmws:financial-event-group '.$store->id.' --started-before=2020-06-27T14:10:00.000-06:00')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchListFinancialEventGroups::class, function($event){
            $listFinancialEventGroups = $event->listFinancialEventGroups;

            return $listFinancialEventGroups->getFinancialEventGroupStartedBefore() === '2020-06-27T20:10:00Z';
        });
    }
}
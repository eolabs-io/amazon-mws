<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Jobs;

use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\ProcessListFinancialEventsResponse;
use EolabsIo\AmazonMws\Domain\Finance\ListFinancialEvents;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PerformFetchListFinancialEvents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\ListFinancialEvents */
    public $listFinancialEvents;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ListFinancialEvents $listFinancialEvents)
    {
        $this->listFinancialEvents = $listFinancialEvents;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->listFinancialEvents->fetch();

        ProcessListFinancialEventsResponse::dispatch($results);
        FetchListFinancialEvents::dispatchIf($this->listFinancialEvents->hasNextToken(), $this->listFinancialEvents);
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forListFinancialEvents()];
    }

}

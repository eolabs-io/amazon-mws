<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Jobs;

use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\ProcessListFinancialEventsResponse;
use EolabsIo\AmazonMws\Domain\Finance\ListFinancialEvents;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\HandlesJobsRequestException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\QuotaExceededException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\RequestThrottledException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class PerformFetchListFinancialEvents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HandlesJobsRequestException;

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
        try {
            $results = $this->listFinancialEvents->fetch();

            ProcessListFinancialEventsResponse::dispatch($results)->onQueue('process-list-financial-events');
            FetchListFinancialEvents::dispatchIf($this->listFinancialEvents->hasNextToken(), $this->listFinancialEvents);
        }
        catch(RequestException $exception) {
            $delay = 30;
            $this->handleRequestException($exception, $delay);
        }
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forListFinancialEvents()];
    }

}

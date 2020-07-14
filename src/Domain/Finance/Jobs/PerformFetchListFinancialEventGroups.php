<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Jobs;

use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEventGroups;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\ProcessListFinancialEventGroupsResponse;
use EolabsIo\AmazonMws\Domain\Finance\ListFinancialEventGroups;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PerformFetchListFinancialEventGroups implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Finance\ListFinancialEventGroups */
    public $listFinancialEventGroups;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ListFinancialEventGroups $listFinancialEventGroups)
    {
        $this->listFinancialEventGroups = $listFinancialEventGroups;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->listFinancialEventGroups->fetch();

        ProcessListFinancialEventGroupsResponse::dispatch($results);
        FetchListFinancialEventGroups::dispatchIf($this->listFinancialEventGroups->hasNextToken(), $this->listFinancialEventGroups);
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forListFinancialEventGroups()];
    }

}

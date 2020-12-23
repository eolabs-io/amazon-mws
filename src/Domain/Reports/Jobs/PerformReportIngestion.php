<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reports\GetReportRequestList;
use EolabsIo\AmazonMws\Domain\Reports\Events\SubmittedRequestReport;
use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;

class PerformReportIngestion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reports\GetReportRequestList */
    public $getReportRequestList;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GetReportRequestList $getReportRequestList)
    {
        $this->getReportRequestList = $getReportRequestList;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->getReportRequestList->fetch();

        SubmittedRequestReport::dispatch($this->requestReport);
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forGetReportRequestList()];
    }
}

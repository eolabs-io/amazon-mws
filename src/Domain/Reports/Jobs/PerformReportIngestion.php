<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reports\GetReportList;
use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;

class PerformReportIngestion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reports\GetReportList */
    public $getReportList;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GetReportList $getReportList)
    {
        $this->getReportList = $getReportList;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $storeId = $this->getReportList->getStoreId();
        $results = $this->getReportList->fetch();
        $hasNext = data_get($results, 'HasNext', false);
        $reportId = data_get($results, 'ReportInfo.ReportId');

        $getReport = GetReport::withStore($storeId)->withReportId($reportId);

        PerformGetReport::dispatch($getReport);
        PerformReportIngestion::dispatchIf($hasNext, $this->getReportList);
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forGetReportList()];
    }
}

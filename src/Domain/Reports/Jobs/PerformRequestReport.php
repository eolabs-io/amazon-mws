<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Jobs;

use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Reports\RequestReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PerformRequestReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reports\RequestReport */
    public $requestReport;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(RequestReport $requestReport)
    {
        $this->requestReport = $requestReport;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->requestReport->fetch();
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forRequestReport()];
    }
}

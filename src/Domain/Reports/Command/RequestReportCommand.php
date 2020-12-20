<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Command;

use EolabsIo\AmazonMws\Domain\Reports\Jobs\PerformRequestReport;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Support\Facades\RequestReport;

class RequestReportCommand extends Command
{
    protected $signature = 'amazonmws:request-report
                            {store : The ID of the store}
                            {--report-type= : indicates the type of report to request}
                            {--start-date= : the start of a date range used for selecting the data to report.}
                            {--end-date= : the end of a date range used for selecting the data to report.}
                            {--report-options= : Additional information to pass to the report.}
                            {--marketplace-ids=* : A list of one or more marketplace IDs for the marketplaces you are registered to sell in.}';

    protected $description = 'Request Report from Amazon MWS';


    public function handle()
    {
        $this->info('Requesting Report from Amazon MWS...');

        $store = Store::find($this->argument('store'));
        $reportType = $this->option('report-type');
        $startDate = $this->option('start-date');
        $endDate = $this->option('end-date');
        $reportOptions = $this->option('report-options');
        $marketplaceIds = $this->option('marketplace-ids');

        $requestedReport = RequestReport::withStore($store);

        if ($reportType) {
            $requestedReport->withReportType($reportType);
        }

        if ($startDate) {
            $requestedReport->withStartDate(Carbon::create($startDate));
        }

        if ($endDate) {
            $requestedReport->withEndDate(Carbon::create($endDate));
        }

        if ($reportOptions) {
            $requestedReport->withReportOptions($reportOptions);
        }

        if (filled($marketplaceIds)) {
            $requestedReport->withMarketplaceIds($marketplaceIds);
        }

        PerformRequestReport::dispatch($requestedReport)->onQueue('request-report');
    }
}

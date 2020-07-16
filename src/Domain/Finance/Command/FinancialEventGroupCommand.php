<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEventGroups;
use EolabsIo\AmazonMws\Support\Facades\ListFinancialEventGroups;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class FinancialEventGroupCommand extends Command
{
    protected $signature = 'amazonmws:financial-event-group
                            {store : The ID of the store}
                            {--started-after= : A date used for selecting financial event groups that opened after (or at) a specified time.}
                            {--started-before= : A date used for selecting financial event groups that opened before (but not at) a specified time.}
                            {--max-results-per-page= : The maximum number of results to return per page.}';

    protected $description = 'Gets FinancialEventGroups from Amazon MWS';


    public function handle()
    {
        $this->info('Getting FinancialEventGroups from Amazon MWS...');

        $store = Store::find($this->argument('store'));
    
        $startedAfter = $this->option('started-after');
        $startedBefore = $this->option('started-before');
        $maxResultsPerPage = $this->option('max-results-per-page');

        $financialEventGroupList = ListFinancialEventGroups::withStore($store);

        if($startedAfter) {
            $financialEventGroupList->withFinancialEventGroupStartedAfter(Carbon::create($startedAfter));
        }

        if($startedBefore) {
            $financialEventGroupList->withFinancialEventGroupStartedBefore(Carbon::create($startedBefore));   
        }

        if($maxResultsPerPage) {
            $financialEventGroupList->withMaxResultsPerPage($maxResultsPerPage);   
        }
 
        FetchListFinancialEventGroups::dispatch($financialEventGroupList);
    }
}
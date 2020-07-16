<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Finance\Events\FetchListFinancialEvents;
use EolabsIo\AmazonMws\Support\Facades\ListFinancialEvents;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class FinancialEventCommand extends Command
{
    protected $signature = 'amazonmws:financial-event
                            {store : The ID of the store}
                            {--max-results-per-page= : The maximum number of results to return per page.}
                            {--amazon-order-id= : The identifier of the order for which you want to obtain all financial events.}
                            {--financial-event-group-id= : The identifier of the financial event group for which you want to obtain all financial events.}
                            {--posted-after= : A date used for selecting financial events posted after (or at) a specified time.}
                            {--posted-before= : A date used for selecting financial events posted before (but not at) a specified time.}';

    protected $description = 'Gets FinancialEvents from Amazon MWS';


    public function handle()
    {
        $this->info('Getting FinancialEvents from Amazon MWS...');

        $store = Store::find($this->argument('store'));
    
        $maxResultsPerPage = $this->option('max-results-per-page');
        $amazonOrderId = $this->option('amazon-order-id');
        $financialEventGroupId = $this->option('financial-event-group-id');
        $postedAfter = $this->option('posted-after');
        $postedBefore = $this->option('posted-before');
        
        $financialEventList = ListFinancialEvents::withStore($store);

        if($maxResultsPerPage) {
            $financialEventList->withMaxResultsPerPage($maxResultsPerPage);   
        }

        if($amazonOrderId) {
            $financialEventList->withAmazonOrderId($amazonOrderId);
        }

        if($financialEventGroupId) {
            $financialEventList->withFinancialEventGroupId($financialEventGroupId);
        }

        if($postedAfter) {
            $financialEventList->withPostedAfter(Carbon::create($postedAfter));   
        }

        if($postedBefore) {
            $financialEventList->withPostedBefore(Carbon::create($postedBefore));   
        }
 
        FetchListFinancialEvents::dispatch($financialEventList);
    }
}
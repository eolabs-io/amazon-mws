<?php

namespace EolabsIo\AmazonMws\Domain\Sellers\Command;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Sellers\Events\FetchListMarketplaceParticipations;
use EolabsIo\AmazonMws\Support\Facades\ListMarketplaceParticipations;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SellerCommand extends Command
{
    protected $signature = 'amazonmws:seller
                            {store : The ID of the store}';

    protected $description = 'Gets the marketplaces a seller participates in.';


    public function handle()
    {
        $this->info('Getting Sellers marketplaces from Amazon MWS...');

        $store = Store::find($this->argument('store'));
        
        $listMarketplaceParticipations = ListMarketplaceParticipations::withStore($store);

        FetchListMarketplaceParticipations::dispatch($listMarketplaceParticipations);
    }
}
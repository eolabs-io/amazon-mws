<?php

namespace EolabsIo\AmazonMws\Domain\Inventory\Jobs;


use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Inventory\Events\FetchInventoryList;
use EolabsIo\AmazonMws\Domain\Inventory\InventoryList;
use EolabsIo\AmazonMws\Domain\Inventory\Jobs\ProcessInventoryListResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PerformFetchInventoryList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Inventory\InventoryList */
    public $inventoryList;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(InventoryList $inventoryList)
    {
        $this->inventoryList = $inventoryList;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->inventoryList->fetch();

        ProcessInventoryListResponse::dispatch($results);
        FetchInventoryList::dispatchIf($this->inventoryList->hasNextToken(), $this->inventoryList);
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forListInventorySupply()];
    }

}

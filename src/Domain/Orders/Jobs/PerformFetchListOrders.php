<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Jobs;

use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrders;
use EolabsIo\AmazonMws\Domain\Orders\Jobs\ProcessListOrdersResponse;
use EolabsIo\AmazonMws\Domain\Orders\ListOrders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PerformFetchListOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    

    /** @var EolabsIo\AmazonMws\Domain\Orders\ListOrders */
    public $listOrders;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ListOrders $listOrders)
    {
        $this->listOrders = $listOrders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->listOrders->fetch();

        ProcessListOrdersResponse::dispatch($results);
        FetchListOrders::dispatchIf($this->listOrders->hasNextToken(), $this->listOrders);
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forListOrders()];
    }

}

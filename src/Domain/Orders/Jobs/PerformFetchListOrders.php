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
    
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 0;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    // public $timeout = 300;

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

    /**
     * Calculate the number of seconds to wait before retrying the job.
     *
     * @return int
     */
    public function retryAfter()
    {
        return 60 * pow(2, $this->attempts());
    }

}

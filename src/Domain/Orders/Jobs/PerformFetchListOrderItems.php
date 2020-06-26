<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Jobs;

use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Orders\Events\FetchListOrderItems;
use EolabsIo\AmazonMws\Domain\Orders\Jobs\ProcessListOrderItemsResponse;
use EolabsIo\AmazonMws\Domain\Orders\ListOrderItems;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PerformFetchListOrderItems implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    // public $tries = 0;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    // public $timeout = 30;

    /** @var EolabsIo\AmazonMws\Domain\Orders\ListOrderItems */
    public $listOrderItems;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ListOrderItems $listOrderItems)
    {
        $this->listOrderItems = $listOrderItems;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->listOrderItems->fetch();

        ProcessListOrderItemsResponse::dispatch($results);
        FetchListOrderItems::dispatchIf($this->listOrderItems->hasNextToken(), $this->listOrderItems);
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forListOrderItems()];
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     *
     * @return int
     */
    // public function retryAfter()
    // {
    //     return 1 * pow(2, $this->attempts());
    // }

}

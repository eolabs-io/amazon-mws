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

}

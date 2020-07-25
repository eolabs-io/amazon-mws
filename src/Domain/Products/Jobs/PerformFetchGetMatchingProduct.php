<?php

namespace EolabsIo\AmazonMws\Domain\Products\Jobs;

use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Products\Events\FetchGetMatchingProduct;
use EolabsIo\AmazonMws\Domain\Products\GetMatchingProduct;
use EolabsIo\AmazonMws\Domain\Products\Jobs\ProcessGetMatchingProductsResponse;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\HandlesJobsRequestException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PerformFetchGetMatchingProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HandlesJobsRequestException;
    

    /** @var EolabsIo\AmazonMws\Domain\Products\GetMatchingProduct */
    public $getMatchingProduct;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GetMatchingProduct $getMatchingProduct)
    {
        $this->getMatchingProduct = $getMatchingProduct;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->getMatchingProduct->fetch();

            ProcessGetMatchingProductsResponse::dispatch($results);
        }
        catch(RequestException $exception) {
            $delay = 30;
            $this->handleRequestException($exception, $delay);
        }
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forGetMatchingProducts()];
    }

}

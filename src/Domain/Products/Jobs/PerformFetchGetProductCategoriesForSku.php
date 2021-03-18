<?php

namespace EolabsIo\AmazonMws\Domain\Products\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\AmazonMws\Domain\Products\GetProductCategoriesForSku;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\HandlesJobsRequestException;
use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Products\Jobs\ProcessGetProductCategoriesForSkuResponse;

class PerformFetchGetProductCategoriesForSku implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HandlesJobsRequestException;


    /** @var EolabsIo\AmazonMws\Domain\Products\GetProductCategoriesForSku */
    public $getProductCategoriesForSku;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GetProductCategoriesForSku $getProductCategoriesForSku)
    {
        $this->getProductCategoriesForSku = $getProductCategoriesForSku;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->getProductCategoriesForSku->fetch();

            ProcessGetProductCategoriesForSkuResponse::dispatch($results);
        } catch (RequestException $exception) {
            $delay = 30;
            $this->handleRequestException($exception, $delay);
        }
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forGetProductCategories()];
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reviews\GetProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\ProcessGetProductReviewResponse;

class PerformFetchGetProductReview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reviews\GetProductReview */
    public $getProductReview;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GetProductReview $getProductReview)
    {
        $this->getProductReview = $getProductReview;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->getProductReview->fetch();
        $results['asin'] = $this->getProductReview->getAsin();
        ProcessGetProductReviewResponse::dispatch($results);

        $nextPage = $this->getProductReview->nextPage();
        FetchGetProductReview::dispatchIf($this->getProductReview->hasNextPage(), $this->getProductReview->withPageNumber($nextPage));
    }
}

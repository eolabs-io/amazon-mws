<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\ProcessGetReviewRatingResponse;

class PerformFetchGetReviewRating implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating */
    public $getReviewRating;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GetReviewRating $getReviewRating)
    {
        $this->getReviewRating = $getReviewRating;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->getReviewRating->fetch();
        $results['asin'] = $this->getReviewRating->getAsin();
        ProcessGetReviewRatingResponse::dispatch($results);
    }
}

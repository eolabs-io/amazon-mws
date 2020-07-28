<?php

namespace EolabsIo\AmazonMws\Domain\Sellers\Jobs;

use EolabsIo\AmazonMwsThrottlingMiddleware\Facades\AmazonMwsThrottlingMiddleware;
use EolabsIo\AmazonMws\Domain\Sellers\Jobs\ProcessListMarketplaceParticipationsResponse;
use EolabsIo\AmazonMws\Domain\Sellers\ListMarketplaceParticipations;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\HandlesJobsRequestException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PerformFetchListMarketplaceParticipations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HandlesJobsRequestException;
    

    /** @var EolabsIo\AmazonMws\Domain\Sellers\ListMarketplaceParticipations */
    public $listMarketplaceParticipations;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ListMarketplaceParticipations $listMarketplaceParticipations)
    {
        $this->listMarketplaceParticipations = $listMarketplaceParticipations;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->listMarketplaceParticipations->fetch();

            ProcessListMarketplaceParticipationsResponse::dispatch($results);
        }
        catch(RequestException $exception) {
            $delay = 120;
            $this->handleRequestException($exception, $delay);
        }
    }

    public function middleware()
    {
        return [AmazonMwsThrottlingMiddleware::forListMarketplaceParticipations()];
    }

}

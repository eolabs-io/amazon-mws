<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Enumerable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reports\Jobs\ImportAmazonFulfilledShipment;

class ImportAmazonFulfilledShipments implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Enumerable $shipments;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Enumerable $shipments)
    {
        $this->shipments = $shipments;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->shipments->each(function ($shipment) {
            ImportAmazonFulfilledShipment::dispatch($shipment)->onQueue(null);
        });
    }
}

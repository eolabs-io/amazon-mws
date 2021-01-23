<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Jobs;

use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Enumerable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;
use Illuminate\Bus\Batchable;

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
            $attributes = ['amazon_order_id' => Arr::get($shipment, 'amazon_order_id')];
            AmazonFulfilledShipment::updateOrCreate($attributes, $shipment);
        });
    }
}

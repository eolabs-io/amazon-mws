<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Jobs;

use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;
use Illuminate\Bus\Batchable;

class ImportAmazonFulfilledShipment implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $shipment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($shipment)
    {
        $this->shipment = $shipment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $attributes = ['shipment_item_id' => Arr::get($this->shipment, 'shipment_item_id')];
        AmazonFulfilledShipment::updateOrCreate($attributes, $this->shipment);
    }
}

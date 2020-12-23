<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Jobs;

use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\FormatsModelAttributes;

class ImportAmazonFulfilledShipment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FormatsModelAttributes;

    /** @var array */
    public $shipment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $shipment)
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
        $amazon_order_id = Arr::get($this->shipment, 'amazon-order-id');

        $values = $this->getFormatedAttributes($this->shipment, new AmazonFulfilledShipment);
        $attributes = compact('amazon_order_id');

        AmazonFulfilledShipment::updateOrCreate($attributes, $values);
    }
}

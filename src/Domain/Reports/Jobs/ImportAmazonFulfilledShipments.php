<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Jobs;

use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use EolabsIo\AmazonMws\Domain\Shared\Csv;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;
use EolabsIo\AmazonMws\Domain\Reports\Jobs\ImportAmazonFulfilledShipment;

class ImportAmazonFulfilledShipments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Csv::from($this->file)
            ->headersToSnakeCase()
            ->getRows()
            ->each(function ($row) {
                $attributes = ['amazon_order_id' => Arr::get($row, 'amazon_order_id')];
                AmazonFulfilledShipment::updateOrCreate($attributes, $row);
            });
    }
}

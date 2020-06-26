<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;

trait InteractsWithFulfillmentChannel
{
    /** @var array */
    private $fulfillmentChannel = [];

    public function withFulfillmentChannelAll(): self
    {
        $this->fulfillmentChannel = [];

        return $this;
    }

    public function withFulfillmentChannelByAmazon(): self
    {
        array_push($this->fulfillmentChannel, 'AFN');

        return $this;
    }

    public function withFulfillmentChannelBySeller(): self
    {
        array_push($this->fulfillmentChannel, 'MFN');

        return $this;
    }

    public function hasFulfillmentChannel(): bool
    {
        return count($this->fulfillmentChannel) > 0;
    }

    public function getFulfillmentChannel(): array
    {
        return $this->fulfillmentChannel;
    }

    public function formattedFulfillmentChannel(): array
    {
        return collect($this->getFulfillmentChannel())->mapWithKeys(function ($item, $key){
             $key++;
             return ["FulfillmentChannel.Channel.{$key}" => $item ];
        })->toArray();
    }

    public function getFulfillmentChannelParameter(): array
    {
        if(! $this->hasFulfillmentChannel()){
            return [];
        }

        return $this->formattedFulfillmentChannel();
    }
}
<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;


trait InteractsWithOrderStatus
{
    /** @var array */
    private $orderStatus = [];

    public function orderStatusAdd($value)
    {
        array_push($this->orderStatus, $value);
    }

    public function withOrderStatusAll(): self
    {
        $this->orderStatus = [];

        return $this;
    }

    public function withOrderStatusPendingAvailability(): self
    {
        $this->orderStatusAdd('PendingAvailability');

        return $this;
    }

    public function withOrderStatusPending(): self
    {
        $this->orderStatusAdd('Pending');

        return $this;
    }

    public function withOrderStatusUnshipped(): self
    {
        $this->orderStatusAdd('Unshipped');
        $this->orderStatusAdd('PartiallyShipped');
        
        return $this;
    }

    public function withOrderStatusPartiallyShipped(): self
    {
        $this->orderStatusAdd('PartiallyShipped');
        $this->orderStatusAdd('Unshipped');

        return $this;
    }

    public function withOrderStatusShipped(): self
    {
        $this->orderStatusAdd('Shipped');

        return $this;
    }

    public function withOrderStatusCanceled(): self
    {
        $this->orderStatusAdd('Canceled');

        return $this;
    }

    public function withOrderStatusUnfulfillable(): self
    {
        $this->orderStatusAdd('Unfulfillable');

        return $this;
    }

    public function hasOrderStatus(): bool
    {
        return count($this->orderStatus) > 0;
    }

    public function getOrderStatus(): array
    {
        return $this->orderStatus;
    }

   public function formattedOrderStatus(): array
    {
         return collect($this->getOrderStatus())->mapWithKeys(function ($item, $key){
             $key++;
             return ["OrderStatus.Status.{$key}" => $item ];
         })->toArray();
    }

    public function getOrderStatusParameter(): array
    {
        if(! $this->hasOrderStatus()){
            return [];
        }

        return $this->formattedOrderStatus();
    }
}
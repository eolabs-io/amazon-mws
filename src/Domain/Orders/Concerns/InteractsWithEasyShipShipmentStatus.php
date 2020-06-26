<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;

use Illuminate\Support\Carbon;


trait InteractsWithEasyShipShipmentStatus
{
    /** @var array */
    private $easyShipShipmentStatus = [];

    public function withEasyShipShipmentStatusAll(): self
    {
        $this->easyShipShipmentStatus = [];

        return $this;
    }

    public function withEasyShipShipmentStatusPendingPickUp(): self
    {
        array_push($this->easyShipShipmentStatus, 'PendingPickUp');

        return $this;
    }

    public function withEasyShipShipmentStatusLabelCanceled(): self
    {
        array_push($this->easyShipShipmentStatus, 'LabelCanceled');

        return $this;
    }

    public function withEasyShipShipmentStatusPickedUp(): self
    {
        array_push($this->easyShipShipmentStatus, 'PickedUp');

        return $this;
    }

    public function withEasyShipShipmentStatusOutForDelivery(): self
    {
        array_push($this->easyShipShipmentStatus, 'OutForDelivery');

        return $this;
    }

    public function withEasyShipShipmentStatusDamaged(): self
    {
        array_push($this->easyShipShipmentStatus, 'Damaged');

        return $this;
    }

    public function withEasyShipShipmentStatusDelivered(): self
    {
        array_push($this->easyShipShipmentStatus, 'Delivered');

        return $this;
    }

    public function withEasyShipShipmentStatusRejectedByBuyer(): self
    {
        array_push($this->easyShipShipmentStatus, 'RejectedByBuyer');

        return $this;
    }

    public function withEasyShipShipmentStatusUndeliverable(): self
    {
        array_push($this->easyShipShipmentStatus, 'Undeliverable');

        return $this;
    }

    public function withEasyShipShipmentStatusReturnedToSeller(): self
    {
        array_push($this->easyShipShipmentStatus, 'ReturnedToSeller');

        return $this;
    }

    public function withEasyShipShipmentStatusReturningToSeller(): self
    {
        array_push($this->easyShipShipmentStatus, 'ReturningToSeller');

        return $this;
    }

    public function withEasyShipShipmentStatusLost(): self
    {
        array_push($this->easyShipShipmentStatus, 'Lost');

        return $this;
    }

    public function hasEasyShipShipmentStatus(): bool
    {
        return count($this->easyShipShipmentStatus) > 0;
    }

    public function getEasyShipShipmentStatus(): array
    {
        return $this->easyShipShipmentStatus;
    }

    public function formattedEasyShipShipmentStatus(): array
    {
        return collect($this->getEasyShipShipmentStatus())->mapWithKeys(function ($item, $key){
             $key++;
             return ["EasyShipShipmentStatus.Status.{$key}" => $item ];
        })->toArray();
    }

    public function getEasyShipShipmentStatusParameter(): array
    {
        if(! $this->hasEasyShipShipmentStatus()){
            return [];
        }

        return $this->formattedEasyShipShipmentStatus();
    }
}
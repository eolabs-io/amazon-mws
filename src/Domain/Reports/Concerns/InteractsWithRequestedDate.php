<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

use Illuminate\Support\Carbon;

trait InteractsWithRequestedDate
{
    /** @var string Unix timestamp of the time. */
    private $requestedFromDate;

    /** @var string Unix timestamp of the time. */
    private $requestedToDate;


    public function withRequestedFromDate(Carbon $requestedFromDate): self
    {
        $this->requestedFromDate = $this->genTime($requestedFromDate);

        return $this;
    }

    public function hasRequestedFromDate(): bool
    {
        return ! is_null($this->requestedFromDate);
    }

    public function getRequestedFromDate(): ?string
    {
        return $this->requestedFromDate;
    }

    public function withRequestedToDate(Carbon $requestedToDate): self
    {
        $this->requestedToDate = $this->genTime($requestedToDate);

        return $this;
    }

    public function hasRequestedToDate(): bool
    {
        return ! is_null($this->requestedToDate);
    }

    public function getRequestedToDate(): ?string
    {
        return $this->requestedToDate;
    }

    public function getRequestedDateParameter(): array
    {
        $timeframe = [];

        if ($this->hasRequestedFromDate()) {
            $timeframe['RequestedFromDate'] = $this->getRequestedFromDate();
        }

        if ($this->hasRequestedToDate()) {
            $timeframe['RequestedToDate'] = $this->getRequestedToDate();
        }

        return $timeframe;
    }
}

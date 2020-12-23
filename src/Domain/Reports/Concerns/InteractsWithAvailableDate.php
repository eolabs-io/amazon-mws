<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

use Illuminate\Support\Carbon;

trait InteractsWithAvailableDate
{
    /** @var string Unix timestamp of the time. */
    private $availableFromDate;

    /** @var string Unix timestamp of the time. */
    private $availableToDate;


    public function withAvailableFromDate(Carbon $availableFromDate): self
    {
        $this->availableFromDate = $this->genTime($availableFromDate);

        return $this;
    }

    public function hasAvailableFromDate(): bool
    {
        return ! is_null($this->availableFromDate);
    }

    public function getAvailableFromDate(): ?string
    {
        return $this->availableFromDate;
    }

    public function withAvailableToDate(Carbon $availableToDate): self
    {
        $this->availableToDate = $this->genTime($availableToDate);

        return $this;
    }

    public function hasAvailableToDate(): bool
    {
        return ! is_null($this->availableToDate);
    }

    public function getAvailableToDate(): ?string
    {
        return $this->availableToDate;
    }

    public function getAvailableDateParameter(): array
    {
        $timeframe = [];

        if ($this->hasAvailableFromDate()) {
            $timeframe['AvailableFromDate'] = $this->getAvailableFromDate();
        }

        if ($this->hasAvailableToDate()) {
            $timeframe['AvailableToDate'] = $this->getAvailableToDate();
        }

        return $timeframe;
    }
}

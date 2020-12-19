<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

use Illuminate\Support\Carbon;

trait InteractsWithReportTimeFrames
{
    /** @var string Unix timestamp of the time. */
    private $startDate;

    /** @var string Unix timestamp of the time. */
    private $endDate;


    public function withStartDate(Carbon $startDate): self
    {
        $this->startDate = $this->genTime($startDate);

        return $this;
    }

    public function hasStartDate(): bool
    {
        return ! is_null($this->startDate);
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function withEndDate(Carbon $endDate): self
    {
        $this->endDate = $this->genTime($endDate);

        return $this;
    }

    public function hasEndDate(): bool
    {
        return ! is_null($this->endDate);
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function getPostedTimeFrameParameter(): array
    {
        $timeframe = [];

        if ($this->hasStartDate()) {
            $timeframe['StartDate'] = $this->getStartDate();
        }

        if ($this->hasEndDate()) {
            $timeframe['EndDate'] = $this->getEndDate();
        }

        return $timeframe;
    }
}

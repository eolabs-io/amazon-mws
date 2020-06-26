<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;

use Illuminate\Support\Carbon;


trait InteractsWithLastUpdatedTimeFrames
{
    /** @var Illuminate\Support\Carbon */
    private $lastUpdatedAfter;

    /** @var Illuminate\Support\Carbon */
    private $lastUpdatedBefore;


    public function withLastUpdatedAfter(Carbon $lastUpdatedAfter): self
    {
        $this->lastUpdatedAfter = $this->genTime($lastUpdatedAfter);

        return $this;
    }

    public function hasLastUpdatedAfter(): bool
    {
        return ! is_null($this->lastUpdatedAfter);
    }

    public function getLastUpdatedAfter(): string
    {
        return $this->lastUpdatedAfter;
    }

    public function withLastUpdatedBefore(Carbon $lastUpdatedBefore): self
    {
        $this->lastUpdatedBefore = $this->genTime($lastUpdatedBefore);

        return $this;
    }

    public function hasLastUpdatedBefore(): bool
    {
        return ! is_null($this->lastUpdatedBefore);
    }

    public function getLastUpdatedBefore(): string
    {
        return $this->lastUpdatedBefore;
    }

    public function withLastUpdatedBetween(Carbon $lastUpdatedAfter, Carbon $lastUpdatedBefore): self
    {
        $this->withLastUpdatedAfter($lastUpdatedAfter)
             ->withLastUpdatedBefore($lastUpdatedBefore);

        return $this;
    }

    public function getLastUpdatedTimeFrameParameter(): array
    {
        $timeframe = [];

        if($this->hasLastUpdatedAfter()) {
            $timeframe['LastUpdatedAfter'] = $this->getLastUpdatedAfter();
        }

        if($this->hasLastUpdatedBefore()) {
            $timeframe['LastUpdatedBefore'] = $this->getLastUpdatedBefore();
        }

        return $timeframe;
    }

}
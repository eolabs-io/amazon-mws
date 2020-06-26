<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;

use Illuminate\Support\Carbon;


trait InteractsWithCreatedTimeFrames
{
    /** @var Illuminate\Support\Carbon */
    private $createdAfter;

    /** @var Illuminate\Support\Carbon */
    private $createdBefore;


    public function withCreatedAfter(Carbon $createdAfter): self
    {
        $this->createdAfter = $this->genTime($createdAfter);

        return $this;
    }

    public function hasCreatedAfter(): bool
    {
        return ! is_null($this->createdAfter);
    }

    public function getCreatedAfter(): ?string
    {
        return $this->createdAfter;
    }

    public function withCreatedBefore(Carbon $createdBefore): self
    {
        $this->createdBefore = $this->genTime($createdBefore);

        return $this;
    }

    public function hasCreatedBefore(): bool
    {
        return ! is_null($this->createdBefore);
    }

    public function getCreatedBefore(): ?string
    {
        return $this->createdBefore;
    }

    public function withCreatedBetween(Carbon $createdAfter, Carbon $createdBefore): self
    {
        $this->withCreatedAfter($createdAfter)
             ->withCreatedBefore($createdBefore);

        return $this;
    }

    public function getCreatedTimeFrameParameter(): array
    {
        $timeframe = [];

        if($this->hasCreatedAfter()) {
            $timeframe['CreatedAfter'] = $this->getCreatedAfter();
        }

        if($this->hasCreatedBefore()) {
            $timeframe['CreatedBefore'] = $this->getCreatedBefore();
        }

        return $timeframe;
    }

}
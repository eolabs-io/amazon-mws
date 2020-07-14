<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Concerns;

use Illuminate\Support\Carbon;


trait InteractsWithPostedTimeFrames
{
    /** @var Illuminate\Support\Carbon */
    private $postedAfter;

    /** @var Illuminate\Support\Carbon */
    private $postedBefore;


    public function withPostedAfter(Carbon $postedAfter): self
    {
        $this->postedAfter = $this->genTime($postedAfter);

        return $this;
    }

    public function hasPostedAfter(): bool
    {
        return ! is_null($this->postedAfter);
    }

    public function getPostedAfter(): ?string
    {
        return $this->postedAfter;
    }

    public function withPostedBefore(Carbon $postedBefore): self
    {
        $this->postedBefore = $this->genTime($postedBefore);

        return $this;
    }

    public function hasPostedBefore(): bool
    {
        return ! is_null($this->postedBefore);
    }

    public function getPostedBefore(): ?string
    {
        return $this->postedBefore;
    }

    public function withPostedBetween(Carbon $postedAfter, Carbon $postedBefore): self
    {
        $this->withPostedAfter($postedAfter)
             ->withPostedBefore($postedBefore);

        return $this;
    }

    public function getPostedTimeFrameParameter(): array
    {
        $timeframe = [];

        if($this->hasPostedAfter()) {
            $timeframe['PostedAfter'] = $this->getPostedAfter();
        }

        if($this->hasPostedBefore()) {
            $timeframe['PostedBefore'] = $this->getPostedBefore();
        }

        return $timeframe;
    }

}
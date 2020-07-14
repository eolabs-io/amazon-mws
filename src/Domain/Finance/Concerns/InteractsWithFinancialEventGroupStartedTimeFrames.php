<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Concerns;

use Illuminate\Support\Carbon;


trait InteractsWithFinancialEventGroupStartedTimeFrames
{
    /** @var Illuminate\Support\Carbon */
    private $financialEventGroupStartedAfter;

    /** @var Illuminate\Support\Carbon */
    private $financialEventGroupStartedBefore;


    public function withFinancialEventGroupStartedAfter(Carbon $financialEventGroupStartedAfter): self
    {
        $this->financialEventGroupStartedAfter = $this->genTime($financialEventGroupStartedAfter);

        return $this;
    }

    public function hasFinancialEventGroupStartedAfter(): bool
    {
        return ! is_null($this->financialEventGroupStartedAfter);
    }

    public function getFinancialEventGroupStartedAfter(): ?string
    {
        return $this->financialEventGroupStartedAfter;
    }

    public function withFinancialEventGroupStartedBefore(Carbon $financialEventGroupStartedBefore): self
    {
        $this->financialEventGroupStartedBefore = $this->genTime($financialEventGroupStartedBefore);

        return $this;
    }

    public function hasFinancialEventGroupStartedBefore(): bool
    {
        return ! is_null($this->financialEventGroupStartedBefore);
    }

    public function getFinancialEventGroupStartedBefore(): ?string
    {
        return $this->financialEventGroupStartedBefore;
    }

    public function withFinancialEventGroupStartedBetween(Carbon $financialEventGroupStartedAfter, Carbon $financialEventGroupStartedBefore): self
    {
        $this->withFinancialEventGroupStartedAfter($financialEventGroupStartedAfter)
             ->withFinancialEventGroupStartedBefore($financialEventGroupStartedBefore);

        return $this;
    }

    public function getFinancialEventGroupStartedTimeFrameParameter(): array
    {
        $timeframe = [];

        if($this->hasFinancialEventGroupStartedAfter()) {
            $timeframe['FinancialEventGroupStartedAfter'] = $this->getFinancialEventGroupStartedAfter();
        }

        if($this->hasFinancialEventGroupStartedBefore()) {
            $timeframe['FinancialEventGroupStartedBefore'] = $this->getFinancialEventGroupStartedBefore();
        }

        return $timeframe;
    }

}
<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

trait InteractsWithMaxCount
{
    /** @var int */
    private $maxCount;

    public function withMaxCount(int $maxCount): self
    {
        if ($maxCount < 0) {
            $maxCount = 1;
        }

        if ($maxCount > 100) {
            $maxCount = 100;
        }

        $this->maxCount = $maxCount;

        return $this;
    }

    public function hasMaxCount(): bool
    {
        return $this->maxCount > 0;
    }

    public function getMaxCountParameter(): array
    {
        return ($this->hasMaxCount()) ? ['MaxCount' => $this->maxCount] : [];
    }
}

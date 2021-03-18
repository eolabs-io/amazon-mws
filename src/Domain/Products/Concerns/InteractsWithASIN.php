<?php

namespace EolabsIo\AmazonMws\Domain\Products\Concerns;

trait InteractsWithASIN
{
    /** @var string */
    private $asin = null;

    public function withAsin(string $asin): self
    {
        $this->asin = $asin;

        return $this;
    }

    public function hasAsin(): bool
    {
        return filled($this->asin);
    }

    public function getAsin(): string
    {
        return $this->asin;
    }

    public function getAsinParameter(): array
    {
        if ($this->hasAsin()) {
            return ['ASIN' => $this->getAsin()];
        }

        return [];
    }
}

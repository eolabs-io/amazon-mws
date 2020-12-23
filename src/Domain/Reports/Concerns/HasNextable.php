<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

use Illuminate\Support\Collection;

trait HasNextable
{
    /** @var bool */
    private $hasNext = false;


    public function checkForHasNext(Collection $results): self
    {
        $hasNext = $results->get('HasNext');
        $this->setHasNext($hasNext);

        return $this;
    }

    public function clearHasNext(): self
    {
        $this->setHasNext(false);

        return $this;
    }

    public function getHasNext(): bool
    {
        return $this->nextToken;
    }

    public function setHasNext(bool $hasNext): self
    {
        $this->hasNext = $hasNext;

        return $this;
    }

    public function hasNext(): bool
    {
        return $this->getHasNext();
    }
}

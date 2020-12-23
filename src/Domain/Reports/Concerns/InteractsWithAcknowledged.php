<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

trait InteractsWithAcknowledged
{
    /** @var int */
    private $acknowledged = null;

    public function withAcknowledged(bool $acknowledged): self
    {
        $this->acknowledged = $acknowledged;

        return $this;
    }

    public function getAcknowledged(): array
    {
        return (filled($this->acknowledged)) ? ['Acknowledged' => $this->acknowledged] : [];
    }
}

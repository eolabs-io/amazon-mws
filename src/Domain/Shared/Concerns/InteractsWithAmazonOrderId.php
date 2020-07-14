<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Concerns;

trait InteractsWithAmazonOrderId
{
    /** @var string */
    private $amazonOrderId;


    public function withAmazonOrderId(string $amazonOrderId): self
    {
        $this->amazonOrderId = $amazonOrderId;

        return $this;
    }

    public function hasAmazonOrderId(): bool
	{
		return ! is_null($this->amazonOrderId);
	}

	public function getAmazonOrderId(): string
	{
		return $this->amazonOrderId;
	}

    public function getAmazonOrderIdParameter(): array
    {
        if(! $this->hasAmazonOrderId()){
            return [];
        }

        return ['AmazonOrderId' => $this->getAmazonOrderId()];
    }

}
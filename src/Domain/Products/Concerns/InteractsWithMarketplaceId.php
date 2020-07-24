<?php

namespace EolabsIo\AmazonMws\Domain\Products\Concerns;

trait InteractsWithMarketplaceId
{
    /** @var string */
    private $marketplaceId = null;

    public function withMarketplaceId(string $marketplaceId): self
    {
        $this->marketplaceId = $marketplaceId;

        return $this;
    }

    public function hasMarketplaceId(): bool
	{
		return ! is_null($this->marketplaceId);
	}

	public function getMarketplaceId(): string
	{
		return $this->marketplaceId;
	}

    public function getMarketplaceIdParameter(): array
    {
        if(! $this->hasMarketplaceId()){
            return [];
        }

        return ['MarketplaceId' => $this->getMarketplaceId()];
    }

}
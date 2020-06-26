<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;

trait InteractsWithMarketplaceIds
{
    /** @var array */
    private $marketplaceIds = [];

    public function withMarketplaceIds(array $marketplaceIds): self
    {
        $this->marketplaceIds = $marketplaceIds;

        return $this;
    }

    public function hasMarketplaceIds(): bool
	{
		return count($this->marketplaceIds) > 0;
	}

	public function getMarketplaceIds(): array
	{
		return $this->marketplaceIds;
	}

    public function formattedMarketplaceIds(): array
    {
         return collect($this->getMarketplaceIds())->mapWithKeys(function ($item, $key){
             $key++;
             return ["MarketplaceId.Id.{$key}" => $item ];
         })->toArray();
    }

    public function getMarketplaceIdsParameter(): array
    {
        if( ! $this->hasMarketplaceIds() ) {
            // Attempt to find them in the store
            $marketplaceIds = $this->getStore()->marketplaces->pluck('marketplace_id')->toArray();
            $this->withMarketplaceIds($marketplaceIds);   
        }

        return $this->formattedMarketplaceIds();

    }

}
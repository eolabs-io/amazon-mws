<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Concerns;

trait InteractsWithMarketplaceIdList
{
    /** @var array */
    private $marketplaceIdList = [];

    public function withMarketplaceIdList(array $marketplaceIdList): self
    {
        $this->marketplaceIdList = $marketplaceIdList;

        return $this;
    }

    public function hasMarketplaceIdList(): bool
    {
        return count($this->marketplaceIdList) > 0;
    }

    public function getMarketplaceIdList(): array
    {
        return $this->marketplaceIdList;
    }

    public function formattedMarketplaceIdList(): array
    {
        return collect($this->getMarketplaceIdList())->mapWithKeys(function ($item, $key) {
            $key++;
            return ["MarketplaceIdList.Id.{$key}" => $item ];
        })->toArray();
    }

    public function getMarketplaceIdListParameter(): array
    {
        if (! $this->hasMarketplaceIdList()) {
            // Attempt to find them in the store
            $marketplaceIdList = $this->getStore()->marketplaces->pluck('marketplace_id')->toArray();
            $this->withMarketplaceIdList($marketplaceIdList);
        }

        return $this->formattedMarketplaceIdList();
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Products\Concerns;

trait InteractsWithSKU
{
    /** @var string */
    private $sku = null;

    public function withSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function hasSku(): bool
    {
        return filled($this->sku);
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getSkuParameter(): array
    {
        if ($this->hasSku()) {
            return ['SellerSKU' => $this->getSku()];
        }

        return [];
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;

trait InteractsWithSellerOrderId
{

	/** @var string */
	private $sellerOrderId = null;

    public function withSellerOrderId(string $sellerOrderId): self
    {
        $this->sellerOrderId = $sellerOrderId;

        return $this;
    }

    public function hasSellerOrderId(): bool
    {
        return ! is_null($this->sellerOrderId);
    }

    public function getSellerOrderId(): string
    {
        return $this->sellerOrderId;
    }

   public function getSellerOrderIdParameter(): array
    {
        if(! $this->hasSellerOrderId()){
            return [];
        }

        return ['SellerOrderId' => $this->getSellerOrderId()];
    }
}
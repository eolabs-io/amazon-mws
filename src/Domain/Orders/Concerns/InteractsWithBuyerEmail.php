<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;

trait InteractsWithBuyerEmail
{
    /** @var string */
    private $buyerEmail;

    public function withBuyerEmail(string $buyerEmail): self
    {
        $this->buyerEmail = $buyerEmail;

        return $this;
    }

    public function hasBuyerEmail(): bool
	{
		return ! is_null($this->buyerEmail);
	}

	public function getBuyerEmail(): string
	{
		return $this->buyerEmail;
	}

    public function getBuyerEmailParameter(): array
    {
        if(! $this->hasBuyerEmail()){
            return [];
        }

        return ['BuyerEmail' => $this->getBuyerEmail()];
    }

}
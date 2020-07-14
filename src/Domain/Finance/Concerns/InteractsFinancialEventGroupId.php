<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Concerns;

trait InteractsFinancialEventGroupId
{
    /** @var string */
    private $financialEventGroupId;


    public function withFinancialEventGroupId(string $financialEventGroupId): self
    {
        $this->financialEventGroupId = $financialEventGroupId;

        return $this;
    }

    public function hasFinancialEventGroupId(): bool
	{
		return ! is_null($this->financialEventGroupId);
	}

	public function getFinancialEventGroupId(): string
	{
		return $this->financialEventGroupId;
	}

    public function getFinancialEventGroupIdParameter(): array
    {
        if(! $this->hasFinancialEventGroupId()){
            return [];
        }

        return ['FinancialEventGroupId' => $this->getFinancialEventGroupId()];
    }

}
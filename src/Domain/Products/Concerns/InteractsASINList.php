<?php

namespace EolabsIo\AmazonMws\Domain\Products\Concerns;


trait InteractsASINList
{
    /** @var array */
    private $asins = [];

    public function withAsins(array $asins): self
    {
        $this->asins = $asins;

        return $this;
    }

    public function hasAsins(): bool
	{
		return count($this->asins) > 0;
	}

	public function getAsins(): array
	{
		return $this->asins;
	}

    public function formattedAsins(): array
    {
         return collect($this->getAsins())->mapWithKeys(function ($item, $key){
             $key++;
             return ["ASINList.ASIN.{$key}" => $item ];
         })->toArray();
    }

    public function getAsinListParameter(): array
    {
        return $this->formattedASINs();
    }

}
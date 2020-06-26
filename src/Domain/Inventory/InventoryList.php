<?php

namespace EolabsIo\AmazonMws\Domain\Inventory;

use EolabsIo\AmazonMws\Domain\Inventory\InventoryCore;
use Illuminate\Support\Carbon;


class InventoryList extends InventoryCore
{

	/** @var string */
	private $queryStartDateTime = null;

	/** @var array */
	private $sellerSkus = null;

	/** @var string */
	private $responseGroup = 'Basic';


	public function resolveOptionalParameters(): void
	{
		$this->mergeParameters( [$this->getFilterParameter(),
								$this->getResponseGroupParameter()]);
	}

	public function withQueryStartDateTime(Carbon $startDateTime): self
	{
		$this->queryStartDateTime = $this->genTime($startDateTime);

		return $this;
	}

	public function withSellerSkus(array $sellerSkus): self
	{
		$this->sellerSkus = $sellerSkus;

		return $this;
	}

	public function withBasicResponseGroup(): self
	{
		$this->responseGroup = 'Basic';

		return $this;
	}

	public function withDetailedResponseGroup(): self
	{
		$this->responseGroup = 'Detailed';

		return $this;
	}

	public function getFilterParameter(): array
	{
		if($this->hasSellerSkus()){
			return $this->formattedSellerSkus();
		}

		if(! $this->hasQueryStartDateTime()){
			$this->withQueryStartDateTime(Carbon::now()->subDays(10));
		}

		return ['QueryStartDateTime' => $this->getQueryStartDateTime()];
	}

	public function hasSellerSkus(): bool
	{
		return ! is_null($this->sellerSkus);
	}

	public function hasQueryStartDateTime(): bool
	{
		return ! is_null($this->queryStartDateTime);
	}

	public function getQueryStartDateTime(): string
	{
		return $this->queryStartDateTime;
	}

	public function getSellerSkus(): array
	{
		return $this->sellerSkus;
	}

	public function formattedSellerSkus(): array
	{
		return collect($this->sellerSkus)->mapWithKeys(function ($item, $key){
			$key++;
			return ["SellerSkus.member.{$key}" => $item ];
		})->toArray();
	}

	public function getResponseGroupParameter(): array
	{
		return ['ResponseGroup' => $this->getResponseGroup()];
	}
	
	public function getResponseGroup(): string
	{
		return $this->responseGroup;
	}

}

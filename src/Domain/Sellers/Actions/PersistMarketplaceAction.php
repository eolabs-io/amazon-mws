<?php

namespace EolabsIo\AmazonMws\Domain\Sellers\Actions;

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistMarketplaceAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
    	return 'ListMarketplaces';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Marketplace);
		$attributes['marketplace_id'] = $values['marketplace_id'];

        Marketplace::updateOrCreate($attributes, $values);
    }

}
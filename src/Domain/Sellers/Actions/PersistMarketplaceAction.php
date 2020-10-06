<?php

namespace EolabsIo\AmazonMws\Domain\Sellers\Actions;

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use Illuminate\Database\Eloquent\Model;

class PersistMarketplaceAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'ListMarketplaces';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Marketplace);
        $attributes['marketplace_id'] = $values['marketplace_id'];

        $marketplace = Marketplace::updateOrCreate($attributes, $values);

        return $marketplace;
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Sellers\Actions;

use EolabsIo\AmazonMwsClient\Models\Participation;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistParticipationAction extends BasePersistAction
{
    use FormatsModelAttributes;
        
    public function getKey(): string
    {
    	return 'ListParticipations';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Participation);
		$attributes['marketplace_id'] = $values['marketplace_id'];
		$attributes['seller_id'] = $values['seller_id'];

        Participation::updateOrCreate($attributes, $values);
    }

}
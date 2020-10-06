<?php

namespace EolabsIo\AmazonMws\Domain\Sellers\Actions;

use EolabsIo\AmazonMwsClient\Models\Participation;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use Illuminate\Database\Eloquent\Model;

class PersistParticipationAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'ListParticipations';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Participation);
        $attributes['marketplace_id'] = $values['marketplace_id'];
        $attributes['seller_id'] = $values['seller_id'];

        $participation = Participation::updateOrCreate($attributes, $values);

        return $participation;
    }
}

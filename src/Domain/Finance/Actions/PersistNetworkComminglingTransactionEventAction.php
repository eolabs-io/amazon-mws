<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTaxAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTaxExclusiveAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\NetworkComminglingTransactionEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedNetworkComminglingTransactionEvent;

class PersistNetworkComminglingTransactionEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'NetworkComminglingTransactionEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new NetworkComminglingTransactionEvent);
        $attributes = ['net_co_transaction_id' => data_get($list, 'NetCoTransactionID'),];

        $networkComminglingTransactionEvent = NetworkComminglingTransactionEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($networkComminglingTransactionEvent);
        }

        $networkComminglingTransactionEvent->push();

        return $networkComminglingTransactionEvent;
    }

    protected function associateActions(): array
    {
        return [
            AssociateTaxExclusiveAmountAction::class,
            AssociateTaxAmountAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedNetworkComminglingTransactionEvent::class;
    }
}

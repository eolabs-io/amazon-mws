<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateReimbursedAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedSAFETReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachSAFETReimbursementItemListAction;

class PersistSAFETReimbursementEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'SAFETReimbursementEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new SafeTReimbursementEvent);

        $safeTReimbursementEvent = SafeTReimbursementEvent::create($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($safeTReimbursementEvent);
        }

        $safeTReimbursementEvent->push();

        return $safeTReimbursementEvent;
    }

    protected function associateActions(): array
    {
        return [
            AssociateReimbursedAmountAction::class,
            AttachSAFETReimbursementItemListAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedSAFETReimbursementEvent::class;
    }
}

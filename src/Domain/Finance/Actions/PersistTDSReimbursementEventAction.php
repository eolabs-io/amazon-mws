<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedTDSReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateReimbursedAmountAction;

class PersistTDSReimbursementEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'TDSReimbursementEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new TDSReimbursementEvent);

        $tdsReimbursementEvent = TDSReimbursementEvent::create($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($tdsReimbursementEvent);
        }

        $tdsReimbursementEvent->push();

        return $tdsReimbursementEvent;
    }

    protected function associateActions(): array
    {
        return [
            AssociateReimbursedAmountAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedTDSReimbursementEvent::class;
    }
}

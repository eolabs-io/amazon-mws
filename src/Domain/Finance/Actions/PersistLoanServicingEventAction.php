<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\LoanServicingEvent;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateLoanAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedLoanServicingEvent;

class PersistLoanServicingEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'LoanServicingEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new LoanServicingEvent);

        $loanServicingEvent = LoanServicingEvent::create($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($loanServicingEvent);
        }

        $loanServicingEvent->push();

        return $loanServicingEvent;
    }

    protected function associateActions(): array
    {
        return [
            AssociateLoanAmountAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedLoanServicingEvent::class;
    }
}

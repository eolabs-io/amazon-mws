<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\RentalTransactionEvent;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachRentalFeeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachRentalChargeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedRentalTransactionEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateRentalInitialValueAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachRentalTaxWithheldListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateRentalReimbursementAction;

class PersistRentalTransactionEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'RentalTransactionEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new RentalTransactionEvent);
        $attributes = ['amazon_order_id' => data_get($list, 'AmazonOrderId'),];

        $rentalTransactionEvent = RentalTransactionEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($rentalTransactionEvent);
        }

        $rentalTransactionEvent->push();

        return $rentalTransactionEvent;
    }

    protected function associateActions(): array
    {
        return [
            AttachRentalChargeListAction::class,
            AttachRentalFeeListAction::class,
            AssociateRentalInitialValueAction::class,
            AssociateRentalReimbursementAction::class,
            AttachRentalTaxWithheldListAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedRentalTransactionEvent::class;
    }
}

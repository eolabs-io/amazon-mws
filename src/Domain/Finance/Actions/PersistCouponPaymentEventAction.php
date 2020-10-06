<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CouponPaymentEvent;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTotalAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedCouponPaymentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateFeeComponentAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeComponentAction;

class PersistCouponPaymentEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'CouponPaymentEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new CouponPaymentEvent);
        $attributes = ['coupon_id' => data_get($list, 'CouponId'),];

        $couponPaymentEvent = CouponPaymentEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($couponPaymentEvent);
        }

        $couponPaymentEvent->push();

        return $couponPaymentEvent;
    }

    protected function associateActions(): array
    {
        return [
            AssociateFeeComponentAction::class,
            AssociateChargeComponentAction::class,
            AssociateTotalAmountAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedCouponPaymentEvent::class;
    }
}

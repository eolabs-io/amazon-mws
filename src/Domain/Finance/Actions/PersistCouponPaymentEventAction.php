<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeComponentAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateFeeComponentAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTotalAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CouponPaymentEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistCouponPaymentEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
    	return 'CouponPaymentEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CouponPaymentEvent);
		$attributes = ['coupon_id' => data_get($list, 'CouponId'),];

        $couponPaymentEvent = CouponPaymentEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($couponPaymentEvent);
        }

        $couponPaymentEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
    		AssociateFeeComponentAction::class,
			AssociateChargeComponentAction::class,
			AssociateTotalAmountAction::class,
    	];
    }
}
<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeComponentAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateFeeComponentAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTotalAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\SellerReviewEnrollmentPaymentEvent;


class PersistSellerReviewEnrollmentPaymentEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'SellerReviewEnrollmentPaymentEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new SellerReviewEnrollmentPaymentEvent);

        $sellerReviewEnrollmentPaymentEvent = SellerReviewEnrollmentPaymentEvent::create($values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($sellerReviewEnrollmentPaymentEvent);
        }

        $sellerReviewEnrollmentPaymentEvent->push();
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
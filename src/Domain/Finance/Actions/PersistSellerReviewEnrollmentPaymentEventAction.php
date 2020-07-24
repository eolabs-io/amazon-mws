<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeComponentAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateFeeComponentAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTotalAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\SellerReviewEnrollmentPaymentEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistSellerReviewEnrollmentPaymentEventAction extends BasePersistAction
{
    use FormatsModelAttributes;
    
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
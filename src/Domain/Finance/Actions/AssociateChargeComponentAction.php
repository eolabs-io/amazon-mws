<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateFeeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;


class AssociateChargeComponentAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'ChargeComponent';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeComponent);
        $chargeComponent = ChargeComponent::create($values);

        (new AssociateChargeAmountAction($list))->execute($chargeComponent);

        $this->model->ChargeComponent()->associate($chargeComponent);
    }
}
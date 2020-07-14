<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;


class AttachItemChargeAdjustmentListAction extends BaseAttachAction 
{
	
    public function getKey(): string
    {
        return 'ItemChargeAdjustmentList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeComponent);
        $chargeComponent = ChargeComponent::create($values);
   
        (new AssociateChargeAmountAction($list))->execute($chargeComponent);

        $chargeComponent->save();

        $this->model->itemChargeAdjustmentList()->attach($chargeComponent);
    }

}
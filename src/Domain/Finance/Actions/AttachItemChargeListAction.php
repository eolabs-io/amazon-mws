<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;


class AttachItemChargeListAction extends BaseAttachAction 
{
	
    public function getKey(): string
    {
        return 'ItemChargeList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeComponent);
        $chargeComponent = ChargeComponent::create($values);
   
        (new AssociateChargeAmountAction($list))->execute($chargeComponent);

        $chargeComponent->save();

        $this->model->itemChargeList()->attach($chargeComponent);
    }

}
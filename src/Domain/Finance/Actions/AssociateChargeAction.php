<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;


class AssociateChargeAction extends BaseAssociateAction 
{

    public function getKey(): string
    {
        return 'Charge';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeComponent);
        $charge = ChargeComponent::create($values);
   
        (new AssociateChargeAmountAction($list))->execute($charge);
        
        $charge->save();

        $this->model->charge()->associate($charge);
    }

}
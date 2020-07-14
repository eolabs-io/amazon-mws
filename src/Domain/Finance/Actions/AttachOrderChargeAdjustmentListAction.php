<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;


class AttachOrderChargeAdjustmentListAction extends BaseAttachAction 
{

    public function getKey(): string
    {
        return 'OrderChargeAdjustmentList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeComponent);
        $orderCharge = ChargeComponent::create($values);
   
        (new AssociateChargeAmountAction($list))->execute($orderCharge);

        $orderCharge->save();

        $this->model->orderChargeAdjustmentList()->attach($orderCharge);
    }

}
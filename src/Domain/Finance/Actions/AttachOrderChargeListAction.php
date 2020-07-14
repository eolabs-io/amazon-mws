<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateManyAction;
use EolabsIo\AmazonMws\Domain\Finance\Concerns\CreatesChargeAmountFromList;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AttachOrderChargeListAction extends BaseAttachAction
{

    public function getKey(): string
    {
        return 'OrderChargeList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeComponent);
        $orderCharge = ChargeComponent::create($values);
   
        (new AssociateChargeAmountAction($list))->execute($orderCharge);

        $orderCharge->save();

        $this->model->orderChargeList()->attach($orderCharge);
    }

}
<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateChargeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;

class AttachTaxesWithheldAction extends BaseAttachAction
{

    public function getKey(): string
    {
        return 'TaxesWithheld';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeComponent);
        $taxesWithheld = ChargeComponent::create($values);
   
        (new AssociateChargeAmountAction($list))->execute($taxesWithheld);
        
        $taxesWithheld->save();

        $this->model->taxesWithheld()->attach($taxesWithheld);
    }

}
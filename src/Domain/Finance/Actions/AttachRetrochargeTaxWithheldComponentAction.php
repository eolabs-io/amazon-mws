<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTaxesWithheldAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;


class AttachRetrochargeTaxWithheldComponentAction extends BaseAttachAction 
{

    public function getKey(): string
    {
        return 'RetrochargeTaxWithheldComponentList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new TaxWithheldComponent);
        $taxWithheldComponent = TaxWithheldComponent::create($values);

        (new AssociateTaxesWithheldAction($list))->execute($taxWithheldComponent);

        $taxWithheldComponent->save();

        $this->model->retrochargeTaxWithheldComponentList()->attach($taxWithheldComponent);
    }

}
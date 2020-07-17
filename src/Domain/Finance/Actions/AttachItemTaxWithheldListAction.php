<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachTaxesWithheldAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;


class AttachItemTaxWithheldListAction extends BaseAttachAction 
{

    public function getKey(): string
    {
        return 'ItemTaxWithheldList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new TaxWithheldComponent);
        $taxWithheldComponent = TaxWithheldComponent::create($values);

        (new AttachTaxesWithheldAction($list))->execute($taxWithheldComponent);

        $taxWithheldComponent->save();

        $this->model->ItemTaxWithheldList()->attach($taxWithheldComponent);
    }

}
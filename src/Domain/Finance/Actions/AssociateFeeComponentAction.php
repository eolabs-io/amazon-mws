<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateFeeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;


class AssociateFeeComponentAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'FeeComponent';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new FeeComponent);
        $feeComponent = FeeComponent::create($values);

        (new AssociateFeeAmountAction($list))->execute($feeComponent);

        $this->model->feeComponent()->associate($feeComponent);
    }
}
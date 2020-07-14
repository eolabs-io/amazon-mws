<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAssociateAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class AssociateShippingTaxAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'ShippingTax';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CurrencyAmount);
        $shippingTax = CurrencyAmount::create($values);

        $this->model->shippingTax()->associate($shippingTax);
    }
}
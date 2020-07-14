<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateBaseExpenseAction;
// use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTaxTypeCGSTAction;
// use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTaxTypeIGSTAction;
// use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTaxTypeSGSTAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTotalExpenseAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;


class PersistAffordabilityExpenseEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'AffordabilityExpenseEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes(data_get($list, 'TaxTypeIGST'), new CurrencyAmount);
        $taxTypeIGST = CurrencyAmount::create($values);

        $values = $this->getFormatedAttributes(data_get($list, 'TaxTypeCGST'), new CurrencyAmount);
        $taxTypeCGST = CurrencyAmount::create($values);

        $values = $this->getFormatedAttributes(data_get($list, 'TaxTypeSGST'), new CurrencyAmount);
        $taxTypeSGST = CurrencyAmount::create($values);

        $values = $this->getFormatedAttributes($list, new AffordabilityExpenseEvent);
        $values['tax_type_igst_id'] = $taxTypeIGST->id;
        $values['tax_type_cgst_id'] = $taxTypeCGST->id;
        $values['tax_type_sgst_id'] = $taxTypeSGST->id;

		$attributes = ['amazon_order_id' => data_get($list, 'AmazonOrderId'),];

        $affordabilityExpenseEvent = AffordabilityExpenseEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($affordabilityExpenseEvent);
        }

        $affordabilityExpenseEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
    		AssociateBaseExpenseAction::class,
    		AssociateTotalExpenseAction::class,
    		// AssociateTaxTypeIGSTAction::class,
    		// AssociateTaxTypeCGSTAction::class,
    		// AssociateTaxTypeSGSTAction::class,
    	];
    }
}

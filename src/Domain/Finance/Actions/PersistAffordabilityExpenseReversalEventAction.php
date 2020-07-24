<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateBaseExpenseAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTotalExpenseAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseReversalEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistAffordabilityExpenseReversalEventAction extends BasePersistAction
{
    use FormatsModelAttributes;
    
    public function getKey(): string
    {
    	return 'AffordabilityExpenseReversalEventList';
    }

    protected function createItem($list)
    {        
        $values = $this->getFormatedAttributes(data_get($list, 'TaxTypeIGST'), new CurrencyAmount);
        $taxTypeIGST = CurrencyAmount::create($values);

        $values = $this->getFormatedAttributes(data_get($list, 'TaxTypeCGST'), new CurrencyAmount);
        $taxTypeCGST = CurrencyAmount::create($values);

        $values = $this->getFormatedAttributes(data_get($list, 'TaxTypeSGST'), new CurrencyAmount);
        $taxTypeSGST = CurrencyAmount::create($values);

        $values = $this->getFormatedAttributes($list, new AffordabilityExpenseReversalEvent);
        $values['tax_type_igst_id'] = $taxTypeIGST->id;
        $values['tax_type_cgst_id'] = $taxTypeCGST->id;
        $values['tax_type_sgst_id'] = $taxTypeSGST->id;

		$attributes = ['amazon_order_id' => data_get($list, 'AmazonOrderId'),];

        $affordabilityExpenseReversalEvent = AffordabilityExpenseReversalEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($affordabilityExpenseReversalEvent);
        }

        $affordabilityExpenseReversalEvent->push();
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

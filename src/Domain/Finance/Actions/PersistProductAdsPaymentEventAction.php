<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateBaseValueAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTaxValueAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateTransactionValueAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ProductAdsPaymentEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistProductAdsPaymentEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
    	return 'ProductAdsPaymentEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ProductAdsPaymentEvent);
		$attributes = ['invoice_id' => data_get($list, 'InvoiceId'),];

        $productAdsPaymentEvent = ProductAdsPaymentEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($productAdsPaymentEvent);
        }

        $productAdsPaymentEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
    		AssociateBaseValueAction::class,
    		AssociateTaxValueAction::class,
    		AssociateTransactionValueAction::class,
    	];
    }
}

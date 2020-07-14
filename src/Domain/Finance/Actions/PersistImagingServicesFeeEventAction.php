<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachFeeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ImagingServicesFeeEvent;


class PersistImagingServicesFeeEventAction extends BasePersistAction
{

    public function getKey(): string
    {
    	return 'ImagingServicesFeeEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ImagingServicesFeeEvent);
		$attributes = ['imaging_request_billing_item_id' => data_get($list, 'ImagingRequestBillingItemID'),];

        $imagingServicesFeeEvent = ImagingServicesFeeEvent::updateOrCreate($attributes, $values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($imagingServicesFeeEvent);
        }

        $imagingServicesFeeEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
            AttachFeeListAction::class,
    	];
    }
}
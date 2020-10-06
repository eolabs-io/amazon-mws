<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachFeeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ImagingServicesFeeEvent;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedImagingServicesFeeEvent;

class PersistImagingServicesFeeEventAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'ImagingServicesFeeEventList';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new ImagingServicesFeeEvent);
        $attributes = ['imaging_request_billing_item_id' => data_get($list, 'ImagingRequestBillingItemID'),];

        $imagingServicesFeeEvent = ImagingServicesFeeEvent::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($imagingServicesFeeEvent);
        }

        $imagingServicesFeeEvent->push();

        return $imagingServicesFeeEvent;
    }

    protected function associateActions(): array
    {
        return [
            AttachFeeListAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedImagingServicesFeeEvent::class;
    }
}

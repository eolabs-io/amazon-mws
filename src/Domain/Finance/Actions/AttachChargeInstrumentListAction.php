<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeInstrument;


class AttachChargeInstrumentListAction extends BaseAttachAction 
{
    public function getKey(): string
    {
        return 'ChargeInstrumentList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeInstrument);
        $chargeInstrument = ChargeInstrument::create($values);

        foreach($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($chargeInstrument);
        }

        $chargeInstrument->save();

        $this->model->chargeInstrumentList()->attach($chargeInstrument);
    }

    private function associateActions(): array
    {
        return [
            AssociateAmountAction::class,
        ];
    }
}
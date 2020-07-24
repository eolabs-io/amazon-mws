<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateLiquidationFeeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateLiquidationProceedsAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\FBALiquidationEvent;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class PersistFBALiquidationEventAction extends BasePersistAction
{
    use FormatsModelAttributes;
         
    public function getKey(): string
    {
    	return 'FBALiquidationEventList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new FBALiquidationEvent);

        $fbaLiquidationEvent = FBALiquidationEvent::create($values);

        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($list))->execute($fbaLiquidationEvent);
        }

        $fbaLiquidationEvent->push();
    }

    protected function associateActions(): array
    {
    	return [
            AssociateLiquidationProceedsAmountAction::class,
            AssociateLiquidationFeeAmountAction::class,
    	];
    }
}
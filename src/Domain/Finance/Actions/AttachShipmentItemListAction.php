<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateCostOfPointsGrantedAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateCostOfPointsReturnedAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachItemChargeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachItemFeeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachItemFeeListAdjustmentAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachItemTaxWithheldListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachPromotionAdjustmentListAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentItem;


class AttachShipmentItemListAction extends BaseAttachAction 
{
	
    
    public function getKey(): string
    {
        return 'ShipmentItemList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ShipmentItem);
        $shipmentItem = ShipmentItem::create($values);

        foreach($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($shipmentItem);
        }

        $shipmentItem->save();

        $this->model->shipmentItemList()->attach($shipmentItem);
    }

    private function associateActions(): array
    {
        return [
            AttachItemChargeListAction::class,
            AttachItemTaxWithheldListAction::class,
            AttachItemChargeAdjustmentListAction::class,
            AttachItemFeeListAction::class,
            AttachItemFeeListAdjustmentAction::class,
            AttachPromotionListAction::class,
            AttachPromotionAdjustmentListAction::class,
            AssociateCostOfPointsGrantedAction::class,
            AssociateCostOfPointsReturnedAction::class,
        ];
    }
}
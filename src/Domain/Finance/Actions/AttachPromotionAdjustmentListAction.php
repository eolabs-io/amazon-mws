<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateFeeAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociatePromotionAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\Promotion;


class AttachPromotionAdjustmentListAction extends BaseAttachAction 
{

    public function getKey(): string
    {
        return 'PromotionAdjustmentList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Promotion); 
        $promotion = Promotion::create($values);

        (new AssociatePromotionAmountAction($list))->execute($promotion);

        $promotion->save();

        $this->model->promotionAdjustmentList()->attach($promotion);
    }

}
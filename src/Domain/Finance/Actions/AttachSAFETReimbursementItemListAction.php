<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AttachItemChargeListAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementItem;


class AttachSAFETReimbursementItemListAction extends BaseAttachAction 
{

    public function getKey(): string
    {
        return 'SAFETReimbursementItemList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new SafeTReimbursementItem);
        $values['safe_t_reimbursement_event_id'] = $this->model->id;

        $safeTReimbursementItem = SafeTReimbursementItem::create($values);
   
        (new AttachItemChargeListAction($list))->execute($safeTReimbursementItem);

        $safeTReimbursementItem->save();
    }

}
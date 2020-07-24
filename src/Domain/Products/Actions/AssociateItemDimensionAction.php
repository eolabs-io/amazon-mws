<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use EolabsIo\AmazonMws\Domain\Products\Models\ItemDimension;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BaseAssociateAction;


class AssociateItemDimensionAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'ItemDimensions';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ItemDimension);
        $itemDimension = ItemDimension::create($values);

        $this->model->itemDimension()->associate($itemDimension);
    }
}
<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use EolabsIo\AmazonMws\Domain\Products\Actions\AssociateItemDimensionAction;
use EolabsIo\AmazonMws\Domain\Products\Actions\AssociatePackageDimensionAction;
use EolabsIo\AmazonMws\Domain\Products\Actions\AssociateSmallImageAction;
use EolabsIo\AmazonMws\Domain\Products\Actions\AttachFeatureAction;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class AttachAttributeSetsAction extends BaseAttachAction 
{
	use FormatsModelAttributes;
	    
    public function getKey(): string
    {
        return 'Product.AttributeSets';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ItemAttributes);
        $values['product_id'] = $this->model->id;
        $itemAttributes = ItemAttributes::create($values);

        foreach($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($itemAttributes);
        }

        $itemAttributes->save();
    }

    private function associateActions(): array
    {
        return [
        	AttachFeatureAction::class,
            AssociateItemDimensionAction::class,
            AssociatePackageDimensionAction::class,
            AssociateSmallImageAction::class,
        ];
    }
}
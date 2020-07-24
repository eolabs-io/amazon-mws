<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use EolabsIo\AmazonMws\Domain\Products\Models\VariationChild;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class AttachRelationshipsAction extends BaseAttachAction 
{
	use FormatsModelAttributes;
	    
    public function getKey(): string
    {
        return 'Product.Relationships.VariationChild';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new VariationChild);
        $values['product_id'] = $this->model->id;
        
        VariationChild::create($values);
    }

}
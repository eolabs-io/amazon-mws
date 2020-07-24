<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use EolabsIo\AmazonMws\Domain\Products\Models\Feature;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BaseAttachAction;


class AttachFeatureAction extends BaseAttachAction 
{
	    
    public function getKey(): string
    {
        return 'Feature';    
    }

    protected function createItem($list)
    {
        $feature = $list;
        $item_attribute_id = $this->model->id;

        Feature::create(compact('feature', 'item_attribute_id'));
    }

}
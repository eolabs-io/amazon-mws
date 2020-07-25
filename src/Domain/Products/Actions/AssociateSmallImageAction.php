<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use EolabsIo\AmazonMws\Domain\Products\Models\Image;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BaseAssociateAction;


class AssociateSmallImageAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'SmallImage';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Image);
        $attributes = $values;
        $smallImage = Image::updateOrCreate($attributes, $values);

        $this->model->smallImage()->associate($smallImage);
    }
}
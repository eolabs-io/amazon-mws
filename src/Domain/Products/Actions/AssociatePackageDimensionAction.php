<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use EolabsIo\AmazonMws\Domain\Products\Models\PackageDimension;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BaseAssociateAction;


class AssociatePackageDimensionAction extends BaseAssociateAction
{
	
    public function getKey(): string
    {
        return 'PackageDimensions';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new PackageDimension);
        $packageDimension = PackageDimension::create($values);

        $this->model->packageDimension()->associate($packageDimension);
    }
}
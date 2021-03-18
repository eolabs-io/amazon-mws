<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use EolabsIo\AmazonMws\Domain\Products\Models\ProductCategory;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BaseAssociateAction;

class AssociateProductCategoryAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'Parent';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ProductCategory);
        $attributes = ['product_category_id' => $values['product_category_id']];

        $productCategory = ProductCategory::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($productCategory);
        }

        $this->model->parent()->associate($productCategory);
    }

    private function associateActions(): array
    {
        return [
            AssociateProductCategoryAction::class,
        ];
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Products\Models\ProductCategory;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\AmazonMws\Domain\Products\Actions\AssociateProductCategoryAction;

class PersistProductCategoriesAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'Self';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new ProductCategory);
        $attributes = ['product_category_id' => $values['product_category_id']];

        $productCategory = ProductCategory::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($productCategory);
        }

        $productCategory->push();

        return $productCategory;
    }

    protected function associateActions(): array
    {
        return [
            AssociateProductCategoryAction::class,
        ];
    }

    public function shouldCreateFromList(): bool
    {
        return false;
    }
}

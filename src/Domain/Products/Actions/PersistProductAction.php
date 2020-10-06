<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use EolabsIo\AmazonMws\Domain\Products\Actions\AttachAttributeSetsAction;
use EolabsIo\AmazonMws\Domain\Products\Actions\AttachRelationshipsAction;
use EolabsIo\AmazonMws\Domain\Products\Actions\AttachSalesRankingsAction;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use Illuminate\Database\Eloquent\Model;

class PersistProductAction extends BasePersistAction
{
    public function getKey(): string
    {
        return 'Products';
    }

    protected function createItem($list): Model
    {
        $status = data_get($list, '@attributes.Status');
        if ($status !== 'Success') {
            $product = new Product;
            return $product;
        }

        $asin = data_get($list, 'Product.Identifiers.MarketplaceASIN.ASIN');
        $marketplace_id = data_get($list, 'Product.Identifiers.MarketplaceASIN.MarketplaceId');
        $values = compact('asin', 'marketplace_id');

        $product = Product::updateOrCreate($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($product);
        }

        $product->push();

        return $product;
    }

    protected function associateActions(): array
    {
        return [
            AttachAttributeSetsAction::class,
            AttachRelationshipsAction::class,
            AttachSalesRankingsAction::class,
        ];
    }
}

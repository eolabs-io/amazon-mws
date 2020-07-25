<?php

namespace EolabsIo\AmazonMws\Domain\Products\Actions;

use EolabsIo\AmazonMws\Domain\Products\Models\SalesRank;
use EolabsIo\AmazonMws\Domain\Products\Models\VariationChild;
use EolabsIo\AmazonMws\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


class AttachSalesRankingsAction extends BaseAttachAction 
{
	use FormatsModelAttributes;
	    
    public function getKey(): string
    {
        return 'Product.SalesRankings.SalesRank';    
    }
    protected function createFromList()
    {
        SalesRank::where('product_id', $this->model->id)->delete();
        parent::createFromList();
    }
    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new SalesRank);
        $values['product_id'] = $this->model->id;
        
        SalesRank::create($values);
    }

}
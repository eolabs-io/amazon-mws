<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Finance\Actions\AssociateDirectPaymentAmountAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\BaseAttachAction;
use EolabsIo\AmazonMws\Domain\Finance\Concerns\CreatesCurrencyAmountFromList;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\DirectPayment;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;


class AttachDirectPaymentListAction extends BaseAttachAction 
{

    public function getKey(): string
    {
        return 'DirectPaymentList';    
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new DirectPayment);
        $directPayment = DirectPayment::create($values);
   
        (new AssociateDirectPaymentAmountAction($list))->execute($directPayment);
        
        $directPayment->save();

        $this->model->directPaymentList()->attach($directPayment);
    }

}
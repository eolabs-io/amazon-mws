<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentExecutionDetailItem;

class PaymentExecutionDetailItemTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return PaymentExecutionDetailItem::class;
    }
}

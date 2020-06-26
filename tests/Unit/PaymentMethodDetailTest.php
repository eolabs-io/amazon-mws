<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentMethodDetail;

class PaymentMethodDetailTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return PaymentMethodDetail::class;
    }
}

<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;

class MoneyTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return Money::class;
    }
}

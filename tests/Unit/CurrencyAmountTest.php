<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class CurrencyAmountTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return CurrencyAmount::class;
    }
}

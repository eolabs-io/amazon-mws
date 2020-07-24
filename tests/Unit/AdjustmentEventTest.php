<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class AdjustmentEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return AdjustmentEvent::class;
    }
    
}

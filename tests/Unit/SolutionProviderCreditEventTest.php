<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceProviderCreditEvent;

class ServiceProviderCreditEventTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return ServiceProviderCreditEvent::class;
    }
}

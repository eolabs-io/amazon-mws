<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\Address;

class AddressTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return Address::class;
    }
}

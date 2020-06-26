<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\TaxClassification;

class TaxClassificationTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return TaxClassification::class;
    }
}

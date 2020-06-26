<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\TaxCollection;

class TaxCollectionTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return TaxCollection::class;
    }
}

<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\PointsGranted;

class PointsGrantedTest extends BaseModelTest
{

    protected function getModelClass()
    {
        return PointsGranted::class;
    }
}

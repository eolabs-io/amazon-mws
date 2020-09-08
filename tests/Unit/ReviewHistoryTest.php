<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ReviewHistory;

class ReviewHistoryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReviewHistory::class;
    }
}

<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Reviews\Models\ReviewRatingHistory;

class ReviewRatingHistoryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReviewRatingHistory::class;
    }
}

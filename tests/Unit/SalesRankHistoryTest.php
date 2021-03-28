<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Products\Models\SalesRank;
use EolabsIo\AmazonMws\Domain\Products\Models\SalesRankHistory;

class SalesRankHistoryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return SalesRankHistory::class;
    }

    /** @test */
    public function it_logs_sales_rank_on_sales_rank_creation()
    {
        // Re-enables Events for test (Faked by default)
        Model::setEventDispatcher($this->initialEvent);
        $asin = 'B1234567879';
        $product = Product::factory()->create(['asin' =>  $asin]);
        $salesRank = SalesRank::factory()->create(['product_id' => $product->id]);
        $salesRank->load('product');

        $this->assertDatabaseCount('sales_rank_histories', 1);
        $this->assertDatabaseHas('sales_rank_histories', [
                'asin' => $salesRank->product->asin,
                'product_category_id' => $salesRank->product_category_id,
                'rank' => $salesRank->rank,
            ]);
    }

    /** @test */
    public function it_logs_sales_rank_on_sales_rank_update()
    {
        $asin = 'B1234567879';
        $product = Product::factory()->create(['asin' =>  $asin]);
        $salesRank = SalesRank::factory()->create(['product_id' => $product->id]);
        $salesRank->load('product');

        // Re-enables Events for test (Faked by default)
        Model::setEventDispatcher($this->initialEvent);

        $newRank = 1111;
        $salesRank->rank = $newRank;
        $salesRank->save();

        $this->assertDatabaseCount('sales_rank_histories', 1);
        $this->assertDatabaseHas('sales_rank_histories', [
                    'asin' => $salesRank->product->asin,
                    'product_category_id' => $salesRank->product_category_id,
                    'rank' => $newRank,
                ]);
    }

    /** @test */
    public function it_can_turn_off_logging()
    {
        $asin = 'B1234567879';
        $product = Product::factory()->create(['asin' =>  $asin]);
        $salesRank = SalesRank::factory()->create(['product_id' => $product->id]);
        $salesRank->load('product');
        // Re-enables Events for test (Faked by default)
        Model::setEventDispatcher($this->initialEvent);

        $newRank = 1111;
        $salesRank->rank = $newRank;
        $salesRank->isLogable = false;
        $salesRank->save();

        $this->assertDatabaseCount('sales_rank_histories', 0);
    }
}

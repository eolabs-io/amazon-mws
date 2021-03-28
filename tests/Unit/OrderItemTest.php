<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use Illuminate\Support\Carbon;
use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Domain\Orders\Models\ProductInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\PointsGranted;
use EolabsIo\AmazonMws\Domain\Orders\Models\TaxCollection;
use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerCustomizedInfo;

class OrderItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return OrderItem::class;
    }

    /** @test */
    public function it_has_buyerCustomizedInfo_relationship()
    {
        $orderItem = OrderItem::factory()->create(['buyer_customized_info_id' => null]);
        $buyerCustomizedInfo = BuyerCustomizedInfo::factory()->create();

        $orderItem->buyerCustomizedInfo()->associate($buyerCustomizedInfo);

        $this->assertArraysEqual($buyerCustomizedInfo->toArray(), $orderItem->buyerCustomizedInfo->toArray());
    }

    /** @test */
    public function it_has_pointsGranted_relationship()
    {
        $order = OrderItem::factory()->create(['points_granted_id' => null]);
        $pointsGranted = PointsGranted::factory()->create();

        $order->pointsGranted()->associate($pointsGranted);

        $this->assertArraysEqual($pointsGranted->toArray(), $order->pointsGranted->toArray());
    }

    /** @test */
    public function it_has_productInfo_relationship()
    {
        $order = OrderItem::factory()->create(['product_info_id' => null]);
        $productInfo = ProductInfo::factory()->create();

        $order->ProductInfo()->associate($productInfo);

        $this->assertArraysEqual($productInfo->toArray(), $order->productInfo->toArray());
    }

    /** @test */
    public function it_has_itemPrice_relationship()
    {
        $order = OrderItem::factory()->create(['item_price_id' => null]);
        $itemPrice = Money::factory()->create();

        $order->itemPrice()->associate($itemPrice);

        $this->assertArraysEqual($itemPrice->toArray(), $order->itemPrice->toArray());
    }

    /** @test */
    public function it_has_shippingPrice_relationship()
    {
        $order = OrderItem::factory()->create(['shipping_price_id' => null]);
        $shippingPrice = Money::factory()->create();

        $order->shippingPrice()->associate($shippingPrice);

        $this->assertArraysEqual($shippingPrice->toArray(), $order->shippingPrice->toArray());
    }

    /** @test */
    public function it_has_giftWrapPrice_relationship()
    {
        $order = OrderItem::factory()->create(['gift_wrap_price_id' => null]);
        $giftWrapPrice = Money::factory()->create();

        $order->giftWrapPrice()->associate($giftWrapPrice);

        $this->assertArraysEqual($giftWrapPrice->toArray(), $order->giftWrapPrice->toArray());
    }

    /** @test */
    public function it_has_taxCollection_relationship()
    {
        $order = OrderItem::factory()->create(['tax_collection_id' => null]);
        $taxCollection = TaxCollection::factory()->create();

        $order->taxCollection()->associate($taxCollection);

        $this->assertArraysEqual($taxCollection->toArray(), $order->taxCollection->toArray());
    }

    /** @test */
    public function it_has_itemTax_relationship()
    {
        $order = OrderItem::factory()->create(['item_tax_id' => null]);
        $itemTax = Money::factory()->create();

        $order->itemTax()->associate($itemTax);

        $this->assertArraysEqual($itemTax->toArray(), $order->itemTax->toArray());
    }

    /** @test */
    public function it_has_shippingTax_relationship()
    {
        $order = OrderItem::factory()->create(['shipping_tax_id' => null]);
        $shippingTax = Money::factory()->create();

        $order->shippingTax()->associate($shippingTax);

        $this->assertArraysEqual($shippingTax->toArray(), $order->shippingTax->toArray());
    }

    /** @test */
    public function it_has_giftWrapTax_relationship()
    {
        $order = OrderItem::factory()->create(['gift_wrap_tax_id' => null]);
        $giftWrapTax = Money::factory()->create();

        $order->giftWrapTax()->associate($giftWrapTax);

        $this->assertArraysEqual($giftWrapTax->toArray(), $order->giftWrapTax->toArray());
    }

    /** @test */
    public function it_has_shippingDiscount_relationship()
    {
        $order = OrderItem::factory()->create(['shipping_discount_id' => null]);
        $shippingDiscount = Money::factory()->create();

        $order->shippingDiscount()->associate($shippingDiscount);

        $this->assertArraysEqual($shippingDiscount->toArray(), $order->shippingDiscount->toArray());
    }

    /** @test */
    public function it_has_shippingDiscountTax_relationship()
    {
        $order = OrderItem::factory()->create(['shipping_discount_tax_id' => null]);
        $shippingDiscountTax = Money::factory()->create();

        $order->shippingDiscountTax()->associate($shippingDiscountTax);

        $this->assertArraysEqual($shippingDiscountTax->toArray(), $order->shippingDiscountTax->toArray());
    }

    /** @test */
    public function it_has_promotionDiscount_relationship()
    {
        $order = OrderItem::factory()->create(['promotion_discount_id' => null]);
        $promotionDiscount = Money::factory()->create();

        $order->promotionDiscount()->associate($promotionDiscount);

        $this->assertArraysEqual($promotionDiscount->toArray(), $order->promotionDiscount->toArray());
    }

    /** @test */
    public function it_has_promotionDiscountTax_relationship()
    {
        $order = OrderItem::factory()->create(['promotion_discount_tax_id' => null]);
        $promotionDiscountTax = Money::factory()->create();

        $order->promotionDiscountTax()->associate($promotionDiscountTax);

        $this->assertArraysEqual($promotionDiscountTax->toArray(), $order->promotionDiscountTax->toArray());
    }

    /** @test */
    public function it_has_codFee_relationship()
    {
        $order = OrderItem::factory()->create(['cod_fee_id' => null]);
        $codFee = Money::factory()->create();

        $order->codFee()->associate($codFee);

        $this->assertArraysEqual($codFee->toArray(), $order->codFee->toArray());
    }

    /** @test */
    public function it_has_codFeeDiscount_relationship()
    {
        $order = OrderItem::factory()->create(['cod_fee_discount_id' => null]);
        $codFeeDiscount = Money::factory()->create();

        $order->codFeeDiscount()->associate($codFeeDiscount);

        $this->assertArraysEqual($codFeeDiscount->toArray(), $order->codFeeDiscount->toArray());
    }

    /** @test */
    public function it_has_order_relationship()
    {
        $order = Order::factory()->create();
        $orderItem = OrderItem::factory()->times(2)->create(['amazon_order_id' => $order->amazon_order_id])->first();
        OrderItem::factory()->times(3)->create();

        $this->assertArraysEqual($order->toArray(), $orderItem->order->toArray());
    }
}

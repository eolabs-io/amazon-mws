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
        $orderItem = factory(OrderItem::class)->create(['buyer_customized_info_id' => null]);
        $buyerCustomizedInfo = factory(BuyerCustomizedInfo::class)->create();

        $orderItem->buyerCustomizedInfo()->associate($buyerCustomizedInfo);

        $this->assertArraysEqual($buyerCustomizedInfo->toArray(), $orderItem->buyerCustomizedInfo->toArray());
    }

    /** @test */
    public function it_has_pointsGranted_relationship()
    {
        $order = factory(OrderItem::class)->create(['points_granted_id' => null]);
        $pointsGranted = factory(PointsGranted::class)->create();

        $order->pointsGranted()->associate($pointsGranted);

        $this->assertArraysEqual($pointsGranted->toArray(), $order->pointsGranted->toArray());
    }

    /** @test */
    public function it_has_productInfo_relationship()
    {
        $order = factory(OrderItem::class)->create(['product_info_id' => null]);
        $productInfo = factory(ProductInfo::class)->create();

        $order->ProductInfo()->associate($productInfo);

        $this->assertArraysEqual($productInfo->toArray(), $order->productInfo->toArray());
    }

    /** @test */
    public function it_has_itemPrice_relationship()
    {
        $order = factory(OrderItem::class)->create(['item_price_id' => null]);
        $itemPrice = factory(Money::class)->create();

        $order->itemPrice()->associate($itemPrice);

        $this->assertArraysEqual($itemPrice->toArray(), $order->itemPrice->toArray());
    }

    /** @test */
    public function it_has_shippingPrice_relationship()
    {
        $order = factory(OrderItem::class)->create(['shipping_price_id' => null]);
        $shippingPrice = factory(Money::class)->create();

        $order->shippingPrice()->associate($shippingPrice);

        $this->assertArraysEqual($shippingPrice->toArray(), $order->shippingPrice->toArray());
    }

    /** @test */
    public function it_has_giftWrapPrice_relationship()
    {
        $order = factory(OrderItem::class)->create(['gift_wrap_price_id' => null]);
        $giftWrapPrice = factory(Money::class)->create();

        $order->giftWrapPrice()->associate($giftWrapPrice);

        $this->assertArraysEqual($giftWrapPrice->toArray(), $order->giftWrapPrice->toArray());
    }

    /** @test */
    public function it_has_taxCollection_relationship()
    {
        $order = factory(OrderItem::class)->create(['tax_collection_id' => null]);
        $taxCollection = factory(TaxCollection::class)->create();

        $order->taxCollection()->associate($taxCollection);

        $this->assertArraysEqual($taxCollection->toArray(), $order->taxCollection->toArray());
    }

    /** @test */
    public function it_has_itemTax_relationship()
    {
        $order = factory(OrderItem::class)->create(['item_tax_id' => null]);
        $itemTax = factory(Money::class)->create();

        $order->itemTax()->associate($itemTax);

        $this->assertArraysEqual($itemTax->toArray(), $order->itemTax->toArray());
    }

    /** @test */
    public function it_has_shippingTax_relationship()
    {
        $order = factory(OrderItem::class)->create(['shipping_tax_id' => null]);
        $shippingTax = factory(Money::class)->create();

        $order->shippingTax()->associate($shippingTax);

        $this->assertArraysEqual($shippingTax->toArray(), $order->shippingTax->toArray());
    }

    /** @test */
    public function it_has_giftWrapTax_relationship()
    {
        $order = factory(OrderItem::class)->create(['gift_wrap_tax_id' => null]);
        $giftWrapTax = factory(Money::class)->create();

        $order->giftWrapTax()->associate($giftWrapTax);

        $this->assertArraysEqual($giftWrapTax->toArray(), $order->giftWrapTax->toArray());
    }

    /** @test */
    public function it_has_shippingDiscount_relationship()
    {
        $order = factory(OrderItem::class)->create(['shipping_discount_id' => null]);
        $shippingDiscount = factory(Money::class)->create();

        $order->shippingDiscount()->associate($shippingDiscount);

        $this->assertArraysEqual($shippingDiscount->toArray(), $order->shippingDiscount->toArray());
    }

    /** @test */
    public function it_has_shippingDiscountTax_relationship()
    {
        $order = factory(OrderItem::class)->create(['shipping_discount_tax_id' => null]);
        $shippingDiscountTax = factory(Money::class)->create();

        $order->shippingDiscountTax()->associate($shippingDiscountTax);

        $this->assertArraysEqual($shippingDiscountTax->toArray(), $order->shippingDiscountTax->toArray());
    }

    /** @test */
    public function it_has_promotionDiscount_relationship()
    {
        $order = factory(OrderItem::class)->create(['promotion_discount_id' => null]);
        $promotionDiscount = factory(Money::class)->create();

        $order->promotionDiscount()->associate($promotionDiscount);

        $this->assertArraysEqual($promotionDiscount->toArray(), $order->promotionDiscount->toArray());
    }

    /** @test */
    public function it_has_promotionDiscountTax_relationship()
    {
        $order = factory(OrderItem::class)->create(['promotion_discount_tax_id' => null]);
        $promotionDiscountTax = factory(Money::class)->create();

        $order->promotionDiscountTax()->associate($promotionDiscountTax);

        $this->assertArraysEqual($promotionDiscountTax->toArray(), $order->promotionDiscountTax->toArray());
    }

    /** @test */
    public function it_has_codFee_relationship()
    {
        $order = factory(OrderItem::class)->create(['cod_fee_id' => null]);
        $codFee = factory(Money::class)->create();

        $order->codFee()->associate($codFee);

        $this->assertArraysEqual($codFee->toArray(), $order->codFee->toArray());
    }

    /** @test */
    public function it_has_codFeeDiscount_relationship()
    {
        $order = factory(OrderItem::class)->create(['cod_fee_discount_id' => null]);
        $codFeeDiscount = factory(Money::class)->create();

        $order->codFeeDiscount()->associate($codFeeDiscount);

        $this->assertArraysEqual($codFeeDiscount->toArray(), $order->codFeeDiscount->toArray());
    }

    /** @test */
    public function it_has_order_relationship()
    {
        $order = factory(Order::class)->create();
        $orderItem = factory(OrderItem::class, 2)->create(['amazon_order_id' => $order->amazon_order_id])->first();
        factory(OrderItem::class, 3)->create();

        $this->assertArraysEqual($order->toArray(), $orderItem->order->toArray());
    }
}

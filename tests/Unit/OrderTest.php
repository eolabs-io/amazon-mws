<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Events\OrderWasCreated;
use EolabsIo\AmazonMws\Domain\Orders\Events\OrderWasUpdated;
use EolabsIo\AmazonMws\Domain\Orders\Models\Address;
use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerTaxInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentExecutionDetailItem;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentMethodDetail;
use Illuminate\Support\Facades\Event;

class OrderTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Order::class;
    }

    /** @test */
    public function it_dispatches_order_was_created_event_on_create()
    {
        $order = Order::factory()->create();

        Event::assertDispatched(function (OrderWasCreated $event) use ($order) {
            return $event->order->id === $order->id;
        });

        Event::assertNotDispatched(OrderWasUpdated::class);
    }

    /** @test */
    public function it_dispatches_order_was_created_event_on_update()
    {
        $order = Order::factory()->create();
        $order->update(Order::factory()->make()->toArray());

        Event::assertDispatched(OrderWasCreated::class, 1);

        Event::assertDispatched(OrderWasUpdated::class, 1);
    }

    /** @test */
    public function it_has_shippingAddress_relationship()
    {
        $order = Order::factory()->create(['shipping_address_id' => null]);
        $address = Address::factory()->create();

        $order->shippingAddress()->associate($address);

        $this->assertArraysEqual($address->toArray(), $order->shippingAddress->toArray());
    }

    /** @test */
    public function it_has_orderTotal_relationship()
    {
        $order = Order::factory()->create(['order_total_id' => null]);
        $orderTotal = Money::factory()->create();

        $order->orderTotal()->associate($orderTotal);

        $this->assertArraysEqual($orderTotal->toArray(), $order->orderTotal->toArray());
    }

    /** @test */
    public function it_has_paymentExecutionDetail_relationship()
    {
        $order = Order::factory()->create();
        $paymentExecutionDetail = PaymentExecutionDetailItem::factory()->times(10)->create(['order_id' => $order->id])->toArray();

        $this->assertArraysEqual(
            $paymentExecutionDetail,
            $order->paymentExecutionDetail->toArray()
        );
    }

    /** @test */
    public function it_has_paymentMethodDetails_relationship()
    {
        $order = Order::factory()->create(['order_total_id' => null]);
        $paymentMethodDetails = PaymentMethodDetail::factory()->create();

        $order->paymentMethodDetails()->associate($paymentMethodDetails);

        $this->assertArraysEqual(
            $paymentMethodDetails->toArray(),
            $order->paymentMethodDetails->toArray()
        );
    }

    /** @test */
    public function it_has_buyerTaxInfo_relationship()
    {
        $order = Order::factory()->create(['order_total_id' => null]);
        $buyerTaxInfo = BuyerTaxInfo::factory()->create();

        $order->buyerTaxInfo()->associate($buyerTaxInfo);

        $this->assertArraysEqual($buyerTaxInfo->toArray(), $order->buyerTaxInfo->toArray());
    }


    /** @test */
    public function it_has_orderItem_relationship()
    {
        $order = Order::factory()->times(2)->create()->first();
        $orderItems = OrderItem::factory()->times(10)->create(['amazon_order_id' => $order->amazon_order_id]);

        $this->assertArraysEqual($orderItems->toArray(), $order->orderItems->toArray());
    }
}

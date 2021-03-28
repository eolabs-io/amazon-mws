<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Tests\Unit\ShipmentEventTest;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\RefundEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentItem;

class RefundEventTest extends ShipmentEventTest
{
    protected function getModelClass()
    {
        return RefundEvent::class;
    }

    /** @test */
    public function it_has_refund_events()
    {
        $buyerEmail = 'foo@bar.com';
        $expectedRefundEvents = 3;

        $orders = Order::factory()->times(10)->create(['buyer_email' => $buyerEmail]);
        $amazonOrderId = $orders->first()->amazon_order_id;

        $orders->each(function ($order) {
            OrderItem::factory()->create([
                'amazon_order_id' => $order->amazon_order_id,
                'seller_sku' => 'sku1',
                'quantity_shipped' => 1
            ]);
        });

        $orders->take($expectedRefundEvents)->each(function ($order) {
            $refundEvent = RefundEvent::factory()->create(['amazon_order_id' => $order->amazon_order_id]);
            $order->orderItems->each(function ($orderItem) use ($refundEvent) {
                $shipmentItem = ShipmentItem::factory()->create([
                    'seller_sku' => $orderItem->seller_sku,
                    'quantity_shipped' => $orderItem->quantity_shipped
                ]);
                $refundEvent->shipmentItemAdjustmentList()->attach($shipmentItem);
            });
        });

        $refundEvent = RefundEvent::where(['amazon_order_id' => $amazonOrderId])->first();
        $numberOfRefundEvents = $refundEvent->numberOfRefundEvents();

        $this->assertEquals($expectedRefundEvents, $numberOfRefundEvents);
    }
}

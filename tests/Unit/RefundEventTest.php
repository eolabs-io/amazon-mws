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

        $orders = factory(Order::class, 10)->create(['buyer_email' => $buyerEmail]);
        $amazonOrderId = $orders->first()->amazon_order_id;
        $orders->take($expectedRefundEvents)->each(function ($order) {
            $amazonOrderId = $order->amazon_order_id;
            $orderItem = factory(OrderItem::class)->create([
                'amazon_order_id' => $amazonOrderId,
                'seller_sku' => 'sku1',
                'quantity_shipped' => 1
            ]);

            $refundEvent = factory(RefundEvent::class)->create(['amazon_order_id' => $amazonOrderId]);
            $shipmentItem = factory(ShipmentItem::class)->create([
                'seller_sku' => $orderItem->seller_sku,
                'quantity_shipped' => $orderItem->quantity_shipped
            ]);
            $refundEvent->shipmentItemAdjustmentList()->attach($shipmentItem);
        });

        $refundEvent = RefundEvent::where(['amazon_order_id' => $amazonOrderId])->first();
        $numberOfRefundEvents = $refundEvent->numberOfRefundEvents();

        $this->assertEquals($expectedRefundEvents, $numberOfRefundEvents);
    }
}

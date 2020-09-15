<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Concerns;

use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Finance\Models\RefundEvent;

trait HasNumberOfRefundEvents
{
    public function numberOfRefundEvents()
    {
        return Order::join('orders as order_history', 'orders.buyer_email', 'order_history.buyer_email')
            ->join('order_items as order_item_history', 'order_history.amazon_order_id', 'order_item_history.amazon_order_id')
            ->where('orders.amazon_order_id', $this->amazon_order_id)
            ->whereIn(
                'seller_sku',
                RefundEvent::with('shipmentItemAdjustmentList')
                    ->where('amazon_order_id', $this->amazon_order_id)
                    ->get()
                    ->pluck('shipmentItemAdjustmentList')
                    ->flatten()
                    ->pluck('seller_sku')
            )
            ->selectRaw('count(*) as numberOfReturns')
            ->pluck('numberOfReturns')
            ->first();
    }
}

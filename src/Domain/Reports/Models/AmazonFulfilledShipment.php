<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Models;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Reports\Events\AmazonFulfilledShipmentWasCreated;
use EolabsIo\AmazonMws\Domain\Reports\Events\AmazonFulfilledShipmentWasUpdated;

class AmazonFulfilledShipment extends Model
{

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => AmazonFulfilledShipmentWasCreated::class,
        'updated' => AmazonFulfilledShipmentWasUpdated::class,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'purchase_date' => 'datetime',
        'payments_date' => 'datetime',
        'shipment_date' => 'datetime',
        'reporting_date' => 'datetime',
        'estimated_arrival_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'amazon_order_id',
                            'merchant_order_id',
                            'shipment_id',
                            'shipment_item_id',
                            'amazon_order_item_id',
                            'merchant_order_item_id',
                            'purchase_date',
                            'payments_date',
                            'shipment_date',
                            'reporting_date',
                            'buyer_email',
                            'buyer_name',
                            'buyer_phone_number',
                            'sku',
                            'product_name',
                            'quantity_shipped',
                            'currency',
                            'item_price',
                            'item_tax',
                            'shipping_price',
                            'shipping_tax',
                            'gift_wrap_price',
                            'gift_wrap_tax',
                            'ship_service_level',
                            'recipient_name',
                            'ship_address1',
                            'ship_address2',
                            'ship_address3',
                            'ship_city',
                            'ship_state',
                            'ship_postal_code',
                            'ship_country',
                            'ship_phone_number',
                            'bill_address1',
                            'bill_address2',
                            'bill_address3',
                            'bill_city',
                            'bill_state',
                            'bill_postal_code',
                            'bill_country',
                            'item_promotion_discount',
                            'ship_promotion_discount',
                            'carrier',
                            'tracking_number',
                            'estimated_arrival_date',
                            'fulfillment_center_id',
                            'fulfillment_channel',
                            'sales_channel',
                ];
}

<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use EolabsIo\AmazonMws\Domain\Orders\Events\OrderWasCreated;
use EolabsIo\AmazonMws\Domain\Orders\Events\OrderWasUpdated;
use EolabsIo\AmazonMws\Domain\Orders\Models\Address;
use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerTaxInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentExecutionDetailItem;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentMethodDetail;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => OrderWasCreated::class,
        'updated' => OrderWasUpdated::class,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'last_update_date' => 'datetime',
        'earliest_ship_date' => 'datetime',
        'latest_ship_date' => 'datetime',
        'earliest_delivery_date' => 'datetime',
        'latest_delivery_date' => 'datetime',
        'promise_response_due_date' => 'datetime',
        'purchase_date' => 'datetime',
        'is_replacement_order' => 'boolean',
        'is_business_order' => 'boolean',
        'is_sold_by_ab' => 'boolean',
        'is_prime' => 'boolean',
        'is_premium_order' => 'boolean',
        'is_global_express_enabled' => 'boolean',
        'is_estimated_ship_dateset' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'amazon_order_id',
                    'seller_order_id',
                    'purchase_date',
                    'last_update_date',
                    'order_status',
                    'fulfillment_channel',
                    'sales_channel',
                    'order_channel',
                    'ship_service_level',
                    'shipping_address_id',
                    'order_total_id',
                    'number_of_items_shipped',
                    'number_of_items_unshipped',
                    'payment_execution_detail_id',
                    'payment_method',
                    'payment_method_details_id',
                    'is_replacement_order',
                    'replaced_order_id',
                    'marketplace_id',
                    'buyer_email',
                    'buyer_name',
                    'buyer_county',
                    'buyer_tax_info_id',
                    'shipment_service_level_category',
                    'easy_ship_shipment_status',
                    'order_type',
                    'earliest_ship_date',
                    'latest_ship_date',
                    'earliest_delivery_date',
                    'latest_delivery_date',
                    'is_business_order',
                    'is_sold_by_ab',
                    'purchase_order_number',
                    'is_prime',
                    'is_premium_order',
                    'is_global_express_enabled',
                    'promise_response_due_date',
                    'is_estimated_ship_dateset',
                    'store_id',
				];


    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id')->withDefault();     
    }             

    public function orderTotal()
    {
        return $this->belongsTo(Money::class, 'order_total_id')->withDefault(); 
    } 

    public function paymentExecutionDetail()
    {
        return $this->hasMany(PaymentExecutionDetailItem::class); 
    }             

    public function paymentMethodDetails()
    {
        return $this->belongsTo(PaymentMethodDetail::class, 'payment_method_details_id')->withDefault(); 
    }    

    public function buyerTaxInfo()
    {
        return $this->belongsTo(BuyerTaxInfo::class, 'buyer_tax_info_id')->withDefault();     
    } 

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'amazon_order_id', 'amazon_order_id');
    }

}
<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Orders\Models\ProductInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\PointsGranted;
use EolabsIo\AmazonMws\Domain\Orders\Models\TaxCollection;
use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerCustomizedInfo;

class OrderItem extends Model
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_gift' => 'boolean',
        'is_transparency' => 'boolean',
        'serial_number_required' => 'boolean',
        'scheduled_delivery_end_date' => 'datetime',
        'scheduled_delivery_start_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'amazon_order_id',
                    'ASIN',
                    'order_item_id',
                    'seller_sku',
                    'buyer_customized_info_id',
                    'title',
                    'quantity_ordered',
                    'quantity_shipped',
                    'points_granted_id',
                    'product_info_id',
                    'item_price_id',
                    'shipping_price_id',
                    'gift_wrap_price_id',
                    'tax_collection_id',
                    'item_tax_id',
                    'shipping_tax_id',
                    'gift_wrap_tax_id',
                    'shipping_discount_id',
                    'shipping_discount_tax_id',
                    'promotion_discount_id',
                    'promotion_discount_tax_id',
                    // 'PromotionIds',
                    'cod_fee_id',
                    'cod_fee_discount_id',
                    'is_gift',
                    'gift_message_text',
                    'gift_wrap_level',
                    'condition_note',
                    'condition_id',
                    'condition_subtype_id',
                    'scheduled_delivery_start_date',
                    'scheduled_delivery_end_date',
                    'price_designation',
                    'is_transparency',
                    'serial_number_required',
                ];


    public function buyerCustomizedInfo()
    {
        return $this->belongsTo(BuyerCustomizedInfo::class, 'buyer_customized_info_id')->withDefault();
    }

    public function pointsGranted()
    {
        return $this->belongsTo(PointsGranted::class, 'points_granted_id')->withDefault();
    }

    public function productInfo()
    {
        return $this->belongsTo(ProductInfo::class, 'product_info_id')->withDefault();
    }

    public function itemPrice()
    {
        return $this->belongsTo(Money::class, 'item_price_id')->withDefault();
    }

    public function shippingPrice()
    {
        return $this->belongsTo(Money::class, 'shipping_price_id')->withDefault();
    }

    public function giftWrapPrice()
    {
        return $this->belongsTo(Money::class, 'gift_wrap_price_id')->withDefault();
    }

    public function taxCollection()
    {
        return $this->belongsTo(TaxCollection::class, 'tax_collection_id')->withDefault();
    }

    public function itemTax()
    {
        return $this->belongsTo(Money::class, 'item_tax_id')->withDefault();
    }

    public function shippingTax()
    {
        return $this->belongsTo(Money::class, 'shipping_tax_id')->withDefault();
    }

    public function giftWrapTax()
    {
        return $this->belongsTo(Money::class, 'gift_wrap_tax_id')->withDefault();
    }

    public function shippingDiscount()
    {
        return $this->belongsTo(Money::class, 'shipping_discount_id')->withDefault();
    }

    public function shippingDiscountTax()
    {
        return $this->belongsTo(Money::class, 'shipping_discount_tax_id')->withDefault();
    }

    public function promotionDiscount()
    {
        return $this->belongsTo(Money::class, 'promotion_discount_id')->withDefault();
    }

    public function promotionDiscountTax()
    {
        return $this->belongsTo(Money::class, 'promotion_discount_tax_id')->withDefault();
    }

    public function codFee()
    {
        return $this->belongsTo(Money::class, 'cod_fee_id')->withDefault();
    }

    public function codFeeDiscount()
    {
        return $this->belongsTo(Money::class, 'cod_fee_discount_id')->withDefault();
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'amazon_order_id', 'amazon_order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ASIN', 'asin');
    }
}

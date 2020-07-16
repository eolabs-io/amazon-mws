<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Jobs;

use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerCustomizedInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Domain\Orders\Models\PointsGranted;
use EolabsIo\AmazonMws\Domain\Orders\Models\ProductInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\TaxCollection;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ProcessListOrderItemsResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FormatsModelAttributes;

    /** @var Illuminate\Support\Collection */
    public $results;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $results)
    {
        $this->results = $results;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->persistListOrders();
    }

    public function persistListOrders()
    {
        $items = data_get($this->results, 'OrderItems');
        array_walk($items, [$this,'createOrderItemFromList']);
    }

    public function createOrderItemFromList($orderItemList)
    {
        $attributes = ['amazon_order_id' => data_get($this->results, 'AmazonOrderId'),
                       'order_item_id' => data_get($orderItemList, 'OrderItemId'),
                        ];
        $values = $this->getFormatedAttributes($orderItemList, new OrderItem);

        $orderItem = OrderItem::updateOrCreate($attributes, $values);

        $this->associateBuyerCustomizedInfo($orderItemList, $orderItem);
        $this->associatePointsGranted($orderItemList, $orderItem);
        $this->associateProductInfo($orderItemList, $orderItem);
        $this->associateItemPrice($orderItemList, $orderItem);
        $this->associateShippingPrice($orderItemList, $orderItem);
        $this->associateGiftWrapPrice($orderItemList, $orderItem);
        $this->associateTaxCollection($orderItemList, $orderItem);
        $this->associateItemTax($orderItemList, $orderItem);
        $this->associateShippingTax($orderItemList, $orderItem);
        $this->associateGiftwraptax($orderItemList, $orderItem);
        $this->associateShippingDiscount($orderItemList, $orderItem);
        $this->associateShippingDiscountTax($orderItemList, $orderItem);
        $this->associatePromotionDiscount($orderItemList, $orderItem);
        $this->associatePromotionDiscountTax($orderItemList, $orderItem);
        $this->associateCodFee($orderItemList, $orderItem);
        $this->associateCodFeeDiscount($orderItemList, $orderItem);

        $orderItem->save();
    }

    public function associateBuyerCustomizedInfo($orderItemList, OrderItem $orderItem)
    {
        $buyerCustomizedInfoList = data_get($orderItemList, 'BuyerCustomizedInfo', null);

        if (!$buyerCustomizedInfoList) {
            return;
        }

        $values = ['customized_url' => data_get($buyerCustomizedInfoList, 'CustomizedURL')];

        $buyerCustomizedInfo = $orderItem->buyerCustomizedInfo;
        $buyerCustomizedInfo->fill($values)->save();

        $orderItem->buyerCustomizedInfo()
                  ->associate($buyerCustomizedInfo);
    }

    public function associatePointsGranted($orderItemList, OrderItem $orderItem)
    {
        $pointsGrantedList = data_get($orderItemList, 'PointsGranted', null);

        if (!$pointsGrantedList) {
            return;
        }

        $values = $this->getFormatedAttributes($pointsGrantedList, new PointsGranted);
        $moneyValues = $this->getFormatedAttributes(data_get($pointsGrantedList, 'PointsMonetaryValue'), new Money);

        $money = Money::create($moneyValues);
        $values['points_monetary_value_id'] = $money->id;

        $pointsGranted = $orderItem->pointsGranted;
        $pointsGranted->fill($values)->save();

        $orderItem->pointsGranted()
                  ->associate($pointsGranted);
    }

    public function associateProductInfo($orderItemList, OrderItem $orderItem)
    {
        $productInfoList = data_get($orderItemList, 'ProductInfo', null);

        if (!$productInfoList) {
            return;
        }

        $values = $this->getFormatedAttributes($productInfoList, new ProductInfo);

        $productInfo = $orderItem->productInfo;
        $productInfo->fill($values)->save();

        $orderItem->Productinfo()
                  ->associate($productInfo);
    }

    public function associateItemPrice($orderItemList, OrderItem $orderItem)
    {
        $itemPriceList = data_get($orderItemList, 'ItemPrice', null);

        if (!$itemPriceList) {
            return;
        }

        $values = $this->getFormatedAttributes($itemPriceList, new Money);

        $itemPrice = $orderItem->itemPrice;
        $itemPrice->fill($values)->save();

        $orderItem->itemPrice()
                  ->associate($itemPrice);
    }

    public function associateShippingPrice($orderItemList, OrderItem $orderItem)
    {
        $shippingPriceList = data_get($orderItemList, 'ShippingPrice', null);

        if (!$shippingPriceList) {
            return;
        }

        $values = $this->getFormatedAttributes($shippingPriceList, new Money);

        $shippingPrice = $orderItem->shippingPrice;
        $shippingPrice->fill($values)->save();

        $orderItem->shippingPrice()
                  ->associate($shippingPrice);
    }

    public function associateGiftWrapPrice($orderItemList, OrderItem $orderItem)
    {
        $giftWrapPriceList = data_get($orderItemList, 'GiftWrapPrice', null);

        if (!$giftWrapPriceList) {
            return;
        }

        $values = $this->getFormatedAttributes($giftWrapPriceList, new Money);

        $giftWrapPrice = $orderItem->giftWrapPrice;
        $giftWrapPrice->fill($values)->save();

        $orderItem->GiftWrapPrice()
                  ->associate($giftWrapPrice);   
    }

    public function associateTaxCollection($orderItemList, OrderItem $orderItem)
    {
        $taxCollectionList = data_get($orderItemList, 'TaxCollection', null);

        if (!$taxCollectionList) {
            return;
        }

        $values = $this->getFormatedAttributes($taxCollectionList, new TaxCollection);

        $taxCollection = $orderItem->taxCollection;
        $taxCollection->fill($values)->save();

        $orderItem->taxCollection()
                  ->associate($taxCollection);         
    }

    public function associateItemTax($orderItemList, OrderItem $orderItem)
    {
        $itemTaxList = data_get($orderItemList, 'ItemTax', null);

        if (!$itemTaxList) {
            return;
        }

        $values = $this->getFormatedAttributes($itemTaxList, new Money);

        $itemTax = $orderItem->itemTax;
        $itemTax->fill($values)->save();

        $orderItem->itemTax()
                  ->associate($itemTax);           
    }

    public function associateShippingTax($orderItemList, OrderItem $orderItem)
    {
        $shippingTaxList = data_get($orderItemList, 'ShippingTax', null);

        if (!$shippingTaxList) {
            return;
        }

        $values = $this->getFormatedAttributes($shippingTaxList, new Money);

        $shippingTax = $orderItem->ShippingTax;
        $shippingTax->fill($values)->save();

        $orderItem->shippingTax()
                  ->associate($shippingTax);           
    }

    public function associateGiftWrapTax($orderItemList, OrderItem $orderItem)
    {
        $giftWrapTaxList = data_get($orderItemList, 'GiftWrapTax', null);

        if (!$giftWrapTaxList) {
            return;
        }

        $values = $this->getFormatedAttributes($giftWrapTaxList, new Money);

        $giftWrapTax = $orderItem->giftWrapTax;
        $giftWrapTax->fill($values)->save();

        $orderItem->giftWrapTax()
                  ->associate($giftWrapTax);           
    }

    public function associateShippingDiscount($orderItemList, OrderItem $orderItem)
    {
        $shippingDiscountList = data_get($orderItemList, 'ShippingDiscount', null);

        if (!$shippingDiscountList) {
            return;
        }

        $values = $this->getFormatedAttributes($shippingDiscountList, new Money);

        $shippingDiscount = $orderItem->shippingDiscount;
        $shippingDiscount->fill($values)->save();

        $orderItem->shippingDiscount()
                  ->associate($shippingDiscount);           
    }

    public function associateShippingDiscountTax($orderItemList, OrderItem $orderItem)
    {
        $shippingDiscountTaxList = data_get($orderItemList, 'ShippingDiscountTax', null);

        if (!$shippingDiscountTaxList) {
            return;
        }

        $values = $this->getFormatedAttributes($shippingDiscountTaxList, new Money);

        $shippingDiscountTax = $orderItem->shippingDiscountTax;
        $shippingDiscountTax->fill($values)->save();

        $orderItem->shippingDiscountTax()
                  ->associate($shippingDiscountTax);           
    }

    public function associatePromotionDiscount($orderItemList, OrderItem $orderItem)
    {
        $promotionDiscountList = data_get($orderItemList, 'PromotionDiscount', null);

        if (!$promotionDiscountList) {
            return;
        }

        $values = $this->getFormatedAttributes($promotionDiscountList, new Money);

        $promotionDiscount = $orderItem->promotionDiscount;
        $promotionDiscount->fill($values)->save();

        $orderItem->promotionDiscount()
                  ->associate($promotionDiscount);           
    }

    public function associatePromotionDiscountTax($orderItemList, OrderItem $orderItem)
    {
        $promotionDiscountTaxList = data_get($orderItemList, 'PromotionDiscountTax', null);

        if (!$promotionDiscountTaxList) {
            return;
        }

        $values = $this->getFormatedAttributes($promotionDiscountTaxList, new Money);

        $promotionDiscountTax = $orderItem->promotionDiscountTax;
        $promotionDiscountTax->fill($values)->save();

        $orderItem->promotionDiscountTax()
                  ->associate($promotionDiscountTax); 
    }

    public function associateCodFee($orderItemList, OrderItem $orderItem)
    {
        $codFeeList = data_get($orderItemList, 'CODFee', null);

        if (!$codFeeList) {
            return;
        }

        $values = $this->getFormatedAttributes($codFeeList, new Money);

        $codFee = $orderItem->codFee;
        $codFee->fill($values)->save();

        $orderItem->codFee()
                  ->associate($codFee); 
    }

    public function associateCodFeeDiscount($orderItemList, OrderItem$orderItem)
    {
        $codFeeDiscountList = data_get($orderItemList, 'CODFeeDiscount', null);

        if (!$codFeeDiscountList) {
            return;
        }

        $values = $this->getFormatedAttributes($codFeeDiscountList, new Money);

        $codFeeDiscount = $orderItem->codFeeDiscount;
        $codFeeDiscount->fill($values)->save();

        $orderItem->codFeeDiscount()
                  ->associate($codFeeDiscount); 
    }
}

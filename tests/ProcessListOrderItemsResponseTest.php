<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMws\Domain\Orders\Jobs\ProcessListOrderItemsResponse;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListOrderItems;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProcessListOrderItemsResponseTest extends TestCase
{

    use RefreshDatabase,
        CreatesListOrderItems;

    protected function setUp(): void
    {
        parent::setUp();
        
        factory(Order::class)->create(["amazon_order_id" => "058-1233752-8214740"]);
        
        $listOrderItems = $this->createListOrderItems();

        $results = $listOrderItems->fetch();

        (new ProcessListOrderItemsResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_list_order_items_response()
    {
        $orderItem = OrderItem::with(['buyerCustomizedInfo'])
                              ->where([ "amazon_order_id" => "058-1233752-8214740",
                                        "ASIN" => "BT0093TELA",
                                        "order_item_id" => "68828574383266", ])->first();

        $this->assertEquals($orderItem->seller_sku, 'CBA_OTF_1');

        // buyerCustomizedInfo relationship                   
        $this->assertEquals($orderItem->buyerCustomizedInfo->customized_url, 
                            "https://zme-caps.amazon.com/t/bR6qHkzSOxuB/J8nbWhze0Bd3DkajkOdY-XQbWkFralegp2sr_QZiKEE/1");

        // PointsGranted
        $this->assertEquals($orderItem->pointsGranted->points_number, 10);
        $this->assertEquals($orderItem->pointsGranted->pointsMonetaryValue->currency_code, "JPY");
        $this->assertEquals($orderItem->pointsGranted->pointsMonetaryValue->amount, "10.00");

        // ProductInfo
        $this->assertEquals($orderItem->productInfo->number_of_items, 12);
    
        // ItemPrice
        $this->assertEquals($orderItem->itemPrice->currency_code, "JPY");
        $this->assertEquals($orderItem->itemPrice->amount, "25.99");

        // ShippingPrice
        $this->assertEquals($orderItem->shippingPrice->currency_code, "JPY");
        $this->assertEquals($orderItem->shippingPrice->amount, "1.26");

        // GiftWrapPrice
        $this->assertEquals($orderItem->giftWrapPrice->currency_code, "JPY");
        $this->assertEquals($orderItem->giftWrapPrice->amount, "1.99");

        // TaxCollection
        $this->assertEquals($orderItem->taxCollection->model, "MarketplaceFacilitator");
        $this->assertEquals($orderItem->taxCollection->responsible_party, "Amazon Services, Inc.");
    
        // ItemTax
        $this->assertEquals($orderItem->itemTax->currency_code, "USD");
        $this->assertEquals($orderItem->itemTax->amount, "0.99");

        // ShippingTax
        $this->assertEquals($orderItem->shippingTax->currency_code, "EUR");
        $this->assertEquals($orderItem->shippingTax->amount, "0.89");

        // GiftWrapTax
        $this->assertEquals($orderItem->giftWrapTax->currency_code, "JPY");
        $this->assertEquals($orderItem->giftWrapTax->amount, "1.90");

        // ShippingDiscount
        $this->assertEquals($orderItem->shippingDiscount->currency_code, "JPY");
        $this->assertEquals($orderItem->shippingDiscount->amount, "1.91");

        // ShippingDiscountTax
        $this->assertEquals($orderItem->shippingDiscountTax->currency_code, "JPY");
        $this->assertEquals($orderItem->shippingDiscountTax->amount, "0.01");

        // promotionDiscount
        $this->assertEquals($orderItem->promotionDiscount->currency_code, "JPY");
        $this->assertEquals($orderItem->promotionDiscount->amount, "11.90");

        // promotionDiscountTax
        $this->assertEquals($orderItem->promotionDiscountTax->currency_code, "USD");
        $this->assertEquals($orderItem->promotionDiscountTax->amount, "0.09");

        // codFee
        $this->assertEquals($orderItem->codFee->currency_code, "JPY");
        $this->assertEquals($orderItem->codFee->amount, "10.01");

        // // codFeeDiscount
        $this->assertEquals($orderItem->codFeeDiscount->currency_code, "JPY");
        $this->assertEquals($orderItem->codFeeDiscount->amount, "1.00");
    }

}
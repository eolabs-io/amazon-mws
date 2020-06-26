<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMws\Domain\Orders\Jobs\ProcessListOrdersResponse;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListOrders;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProcessListOrdersResponseTest extends TestCase
{

    use RefreshDatabase,
        CreatesListOrders;


    protected function setUp(): void
    {
        parent::setUp();
        
        $listOrders = $this->createListOrders();

        $results = $listOrders->fetch();

        (new ProcessListOrdersResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_list_orders_response()
    {
        $order = Order::where(["amazon_order_id" => "902-3159896-1390916"])->first();

        $this->assertEquals($order->store_id, 1);

        $this->assertEquals($order->amazon_order_id, '902-3159896-1390916');
        // $this->assertEquals($order->purchase_date, '2017-02-20T19:49:35Z');
        // $this->assertEquals($order->last_update_date, "2017-02-20T19:49:35Z");
        $this->assertEquals($order->order_status, "Unshipped");
        $this->assertEquals($order->fulfillment_channel, "MFN");
        $this->assertEquals($order->sales_channel, "Amazon.com");
        

        $this->assertDatabaseHas('addresses', [ "name" => "Buyer name",
                                                "address_line_1" => "1234 Any St.",
                                                "city" => "Seattle",
                                                "postal_code" => "98103",
                                                "country_code" => "US",
                                                "address_type" => "Commercial",
                                              ]);

        $this->assertDatabaseHas('money', ["currency_code" => "USD", "amount" => "25.00"]);
        $this->assertDatabaseHas('money', ["currency_code" => "JPY", "amount" => "10.00"]);
        $this->assertDatabaseHas('money', ["currency_code" => "JPY", "amount" => "317.00"]);
        $this->assertDatabaseHas('money',  ["currency_code" => "JPY", "amount" => "1180.00"]);                                     

        $this->assertDatabaseHas('payment_execution_detail_items', ["payment_method" => "PointsAccount"]);
        $this->assertDatabaseHas('payment_execution_detail_items', ["payment_method" => "GC"]);
        $this->assertDatabaseHas('payment_execution_detail_items', ["payment_method" => "COD"]);

        $this->assertDatabaseHas('payment_method_details', [ "payment_method_detail" => "CreditCard"]);

        $this->assertDatabaseHas('buyer_tax_infos', [ "company_legal_name" => "Company Name","taxing_region" => "US"]);   
        $this->assertDatabaseHas('buyer_tax_infos', [ "company_legal_name" => null,"taxing_region" => "BR"]);      

    }

}
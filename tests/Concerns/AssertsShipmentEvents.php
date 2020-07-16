<?php

namespace EolabsIo\AmazonMws\Tests\Concerns;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargebackEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\GuaranteeClaimEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\RefundEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentEvent;


trait AssertsShipmentEvents
{
    /** @var EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentEvent */
    public $shipmentEvent;


    public function assertShipmentEventResponse()
    {
        $shipmentEvent = ShipmentEvent::where(["seller_order_id" => "105-0457358-1245022"])
                                    ->first();

        $this->assertSeesShipmentEvent($shipmentEvent);
    }

    public function assertRefundEventResponse()
    {
        $refundEvent = RefundEvent::where(["seller_order_id" => "105-0457358-1245022"])
                                    ->first();

        $this->assertSeesShipmentEvent($refundEvent);
    }

    public function assertGuaranteeClaimEventResponse()
    {
        $guaranteeClaimEvent = GuaranteeClaimEvent::where(["seller_order_id" => "105-0457358-1245022"])
                                    ->first();

        $this->assertSeesShipmentEvent($guaranteeClaimEvent);
    }

    public function assertChargebackEventResponse()
    {
        $chargebackEvent = ChargebackEvent::where(["seller_order_id" => "105-0457358-1245022"])
                                        ->first();

        $this->assertSeesShipmentEvent($chargebackEvent);
    }

    public function assertSeesShipmentEvent($event)
    {
        $this->shipmentEvent = $event;

        $this->assertEquals($this->shipmentEvent->amazon_order_id, "105-0457358-1245022");
        $this->assertEquals($this->shipmentEvent->marketplace_name, "Amazon.com");

        $this->assertOrderCharges();
        $this->assertOrderChargeAdjustments();
        $this->assertShipmentFees();
        $this->assertShipmentFeeAdjustments();
        $this->assertOrderFees();
        $this->assertOrderFeeAdjustments();
        $this->assertDirectPayments();
        $this->assertShipmentItems();
        $this->assertShipmentItemAdjustments();

        $this->shipmentEvent = null;
    }

    public function assertOrderCharges()
    {
        $orderCharges = $this->shipmentEvent->orderChargeList->load('chargeAmount')->toArray();

        $this->assertEquals($orderCharges[0]['charge_type'], "Principal");
        $this->assertEquals($orderCharges[1]['charge_amount']['currency_amount'], 25.99);
    }

    public function assertOrderChargeAdjustments()
    {
        $orderChargeAdjustments = $this->shipmentEvent->orderChargeAdjustmentList->load('chargeAmount')->toArray();

        $this->assertEquals($orderChargeAdjustments[0]['charge_amount']['currency_amount'], 2.99);
        $this->assertEquals($orderChargeAdjustments[1]['charge_amount']['currency_amount'], 1.99);
    }

    public function assertShipmentFees()
    {
        $shipmentFees = $this->shipmentEvent->shipmentFeeList->load('feeAmount')->toArray();

        $this->assertEquals($shipmentFees[0]['fee_amount']['currency_amount'], 4.99);
        $this->assertEquals($shipmentFees[1]['fee_amount']['currency_amount'], 3.99);   
    }

    public function assertShipmentFeeAdjustments()
    {
        $shipmentFeeAdjustments = $this->shipmentEvent->shipmentFeeAdjustmentList->load('feeAmount')->toArray();

        $this->assertEquals($shipmentFeeAdjustments[0]['fee_amount']['currency_amount'], 0.99);
        $this->assertEquals($shipmentFeeAdjustments[1]['fee_amount']['currency_amount'], 2.99); 
    }

    public function assertOrderFees()
    {
        $orderFees = $this->shipmentEvent->orderFeeList->load('feeAmount')->toArray();
        
        $this->assertEquals($orderFees[0]['fee_amount']['currency_amount'], 4.90);
        $this->assertEquals($orderFees[1]['fee_amount']['currency_amount'], 3.19);  
    }

    public function assertOrderFeeAdjustments()
    {
        $orderFeeAdjustments = $this->shipmentEvent->orderFeeAdjustmentList->load('feeAmount')->toArray();

        $this->assertEquals($orderFeeAdjustments[0]['fee_amount']['currency_amount'], 1.19);
        $this->assertEquals($orderFeeAdjustments[1]['fee_amount']['currency_amount'], 2.69); 
    }

    public function assertDirectPayments()
    {
        $directPayments = $this->shipmentEvent->directPaymentList->load('directPaymentAmount')->toArray();

        $this->assertEquals($directPayments[0]['direct_payment_type'], 'StoredValueCardRevenue');
        $this->assertEquals($directPayments[0]['direct_payment_amount']['currency_amount'], 2.99); 
        $this->assertEquals($directPayments[1]['direct_payment_type'], 'PrivateLabelCreditCardRefund');
        $this->assertEquals($directPayments[1]['direct_payment_amount']['currency_amount'], 17.99); 
    }

    public function assertShipmentItems()
    {
        $shipmentItems = $this->shipmentEvent->shipmentItemList
                                       ->load(['itemChargeList.chargeAmount', 
                                               'itemTaxWithheldList.taxesWithheld.chargeAmount', 
                                               'itemChargeAdjustmentList.chargeAmount',
                                               'itemFeeList.feeAmount', 
                                               'itemFeeAdjustmentList.feeAmount', 
                                               'promotionList.promotionAmount', 
                                               'promotionAdjustmentList.promotionAmount', 
                                               'costOfPointsGranted', 
                                               'costOfPointsReturned', ]
                                        )
                                       ->toArray();

       $this->assertShipmentItem($shipmentItems);

   }

    public function assertShipmentItemAdjustments()
    {
       $shipmentItemAdjustments = $this->shipmentEvent->shipmentItemAdjustmentList
                                       ->load(['itemChargeList.chargeAmount', 
                                               'itemTaxWithheldList.taxesWithheld.chargeAmount', 
                                               'itemChargeAdjustmentList.chargeAmount',
                                               'itemFeeList.feeAmount', 
                                               'itemFeeAdjustmentList.feeAmount', 
                                               'promotionList.promotionAmount', 
                                               'promotionAdjustmentList.promotionAmount', 
                                               'costOfPointsGranted', 
                                               'costOfPointsReturned',])
                                       ->toArray();

        $this->assertShipmentItem($shipmentItemAdjustments);
    }

    public function assertShipmentItem($shipmentItems)
    {
        $this->assertEquals($shipmentItems[0]['seller_sku'], 'HS223A-C00');
        $this->assertEquals($shipmentItems[0]['order_item_id'], "46432915698730"); 
        $this->assertEquals($shipmentItems[0]['item_charge_list'][0]['charge_type'], "_Principal"); 
        $this->assertEquals($shipmentItems[0]['item_charge_list'][0]['charge_amount']['currency_amount'], 26.99); 
        $this->assertEquals($shipmentItems[0]['item_charge_list'][1]['charge_type'], "Tax"); 
        $this->assertEquals($shipmentItems[0]['item_charge_list'][1]['charge_amount']['currency_amount'], 0.0); 

        $itemTaxWithheldList = $shipmentItems[0]['item_tax_withheld_list'];
        $this->assertEquals($itemTaxWithheldList[0]['tax_collection_model'], "MarketplaceFacilitator"); 
        $this->assertEquals($itemTaxWithheldList[1]['taxes_withheld'][0]['charge_amount']['currency_amount'], 0.41); 

        $itemTaxWithheldAdjustmentList = $shipmentItems[0]['item_charge_adjustment_list'];
        $this->assertEquals($itemTaxWithheldAdjustmentList[0]['charge_type'], "_Principal"); 
        $this->assertEquals($itemTaxWithheldAdjustmentList[1]['charge_amount']['currency_amount'], 0.0); 

        $itemFeeList = $shipmentItems[0]['item_fee_list'];
        $this->assertEquals($itemFeeList[0]['fee_type'], "ShippingChargeback"); 
        $this->assertEquals($itemFeeList[1]['fee_amount']['currency_amount'], 0.0); 

        $itemFeeAdjustmentList = $shipmentItems[0]['item_fee_adjustment_list'];
        $this->assertEquals($itemFeeAdjustmentList[0]['fee_type'], "VariableClosingFee"); 
        $this->assertEquals($itemFeeAdjustmentList[1]['fee_amount']['currency_amount'], 0.01); 
        
        $promotionList = $shipmentItems[0]['promotion_list'];
        $this->assertEquals($promotionList[0]['promotion_type'], "type of promotion"); 
        $this->assertEquals($promotionList[1]['promotion_amount']['currency_amount'], 2.2); 
        
        $promotionAdjustmentList = $shipmentItems[0]['promotion_adjustment_list'];
        $this->assertEquals($promotionAdjustmentList[0]['promotion_type'], "type of promotion"); 
        $this->assertEquals($promotionAdjustmentList[1]['promotion_amount']['currency_amount'], 0.02);  

        $costOfPointsGranted = $shipmentItems[0]['cost_of_points_granted'];
        $this->assertEquals($costOfPointsGranted['currency_amount'], 2.12); 

        $costOfPointsReturned = $shipmentItems[0]['cost_of_points_returned'];
        $this->assertEquals($costOfPointsReturned['currency_amount'], 1.12); 
    }
}
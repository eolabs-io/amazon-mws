<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Financial;

use EolabsIo\AmazonMws\Domain\Finance\Jobs\ProcessListFinancialEventsResponse;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsAdjustmentEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsAffordabilityExpenseEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsAffordabilityExpenseReversalEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsCouponPaymentEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsDebtRecoveryEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsFBALiquidationEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsImagingServicesFeeEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsLoanServicingEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsNetworkComminglingTransactionEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsPayWithAmazonEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsProductAdsPaymentEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsRentalTransactionEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsRetrochargeEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsSafeTReimbursementEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsSellerReviewEnrollmentPaymentEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsServiceFeeEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsServiceProviderCreditEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsShipmentEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsTDSReimbursementEvents;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListFinancialEvent;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProcessListFinancialEventsResponseTest extends TestCase
{

    use RefreshDatabase,
        CreatesListFinancialEvent,
        AssertsShipmentEvents,
        AssertsPayWithAmazonEvents,
        AssertsServiceProviderCreditEvents,
        AssertsRetrochargeEvents,
        AssertsRentalTransactionEvents,
        AssertsProductAdsPaymentEvents,
        AssertsServiceFeeEvents,
        AssertsDebtRecoveryEvents,
        AssertsLoanServicingEvents,
        AssertsAdjustmentEvents,
        AssertsCouponPaymentEvents,
        AssertsSafeTReimbursementEvents,
        AssertsSellerReviewEnrollmentPaymentEvents,
        AssertsFBALiquidationEvents,
        AssertsImagingServicesFeeEvents,
        AssertsAffordabilityExpenseEvents,
        AssertsAffordabilityExpenseReversalEvents,
        AssertsNetworkComminglingTransactionEvents,
        AssertsTDSReimbursementEvents;


    protected function setUp(): void
    {
        parent::setUp();
        
        $listFinancialEvents = $this->createListFinancialEvent();

        $results = $listFinancialEvents->fetch();

        (new ProcessListFinancialEventsResponse($results))->handle();

    }

    /** @test */
    public function it_can_process_list_financial_events_response()
    {
        $this->assertShipmentEventResponse();
        $this->assertRefundEventResponse();
        $this->assertGuaranteeClaimEventResponse();
        $this->assertChargebackEventResponse();
        $this->assertPayWithAmazonEventResponse();
        $this->assertServiceProviderCreditEventResponse();
        $this->assertRetrochargeEventResponse();
        $this->assertRentalTransactionEventResponse();
        $this->assertProductAdsPaymentEventResponse();
        $this->assertServiceFeeEventResponse();
        $this->assertDebtRecoveryEventResponse();
        $this->assertLoanServicingEventResponse();
        $this->assertAdjustmentEventResponse();
        $this->assertCouponPaymentEventResponse();
        $this->assertSafeTReimbursementEventResponse();
        $this->assertSellerReviewEnrollmentPaymentEventResponse();
        $this->assertFBALiquidationEventResponse();
        $this->assertImagingServicesFeeEventResponse();
        $this->assertAffordabilityExpenseEventResponse();
        $this->assertAffordabilityExpenseReversalEventResponse();
        $this->assertNetworkComminglingTransactionEventResponse();
        $this->assertTDSReimbursementEventResponse();
    }

}
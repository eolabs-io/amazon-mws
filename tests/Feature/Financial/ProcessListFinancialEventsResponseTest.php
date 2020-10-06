<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Financial;

use Illuminate\Support\Facades\Event;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsShipmentEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsAdjustmentEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsServiceFeeEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsRetrochargeEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsDebtRecoveryEvents;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListFinancialEvent;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsCouponPaymentEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsLoanServicingEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsPayWithAmazonEvents;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedRefundEvent;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsFBALiquidationEvents;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedShipmentEvent;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsTDSReimbursementEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsProductAdsPaymentEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsRentalTransactionEvents;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedAdjustmentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedChargebackEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedServiceFeeEvent;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsImagingServicesFeeEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsSafeTReimbursementEvents;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedRetrochargeEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedDebtRecoveryEvent;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsAffordabilityExpenseEvents;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedCouponPaymentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedLoanServicingEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedPayWithAmazonEvent;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsServiceProviderCreditEvents;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedFBALiquidationEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedGuaranteeClaimEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedTDSReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedProductAdsPaymentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedRentalTransactionEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedImagingServicesFeeEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedSAFETReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Finance\Jobs\ProcessListFinancialEventsResponse;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedAffordabilityExpenseEvent;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsAffordabilityExpenseReversalEvents;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedServiceProviderCreditEvent;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsNetworkComminglingTransactionEvents;
use EolabsIo\AmazonMws\Tests\Concerns\AssertsSellerReviewEnrollmentPaymentEvents;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedAffordabilityExpenseReversalEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedNetworkComminglingTransactionEvent;
use EolabsIo\AmazonMws\Domain\Finance\Events\PersistedSellerReviewEnrollmentPaymentEvent;

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

    /** @test */
    public function it_fires_event_when_persisted()
    {
        Event::assertDispatched(PersistedShipmentEvent::class, 1);
        Event::assertDispatched(PersistedRefundEvent::class, 1);
        Event::assertDispatched(PersistedGuaranteeClaimEvent::class, 1);
        Event::assertDispatched(PersistedChargebackEvent::class, 1);
        Event::assertDispatched(PersistedPayWithAmazonEvent::class, 2);
        Event::assertDispatched(PersistedServiceProviderCreditEvent::class, 2);
        Event::assertDispatched(PersistedRetrochargeEvent::class, 1);
        Event::assertDispatched(PersistedRentalTransactionEvent::class, 1);
        // Event::assertDispatched(PersistedPerformanceBondRefundEvent::class, 2);
        Event::assertDispatched(PersistedProductAdsPaymentEvent::class, 1);
        Event::assertDispatched(PersistedServiceFeeEvent::class, 1);
        Event::assertDispatched(PersistedDebtRecoveryEvent::class, 1);
        Event::assertDispatched(PersistedLoanServicingEvent::class, 1);
        Event::assertDispatched(PersistedAdjustmentEvent::class, 1);
        Event::assertDispatched(PersistedCouponPaymentEvent::class, 1);
        Event::assertDispatched(PersistedSAFETReimbursementEvent::class, 1);
        Event::assertDispatched(PersistedSellerReviewEnrollmentPaymentEvent::class, 1);
        Event::assertDispatched(PersistedFBALiquidationEvent::class, 1);
        Event::assertDispatched(PersistedImagingServicesFeeEvent::class, 1);
        Event::assertDispatched(PersistedAffordabilityExpenseEvent::class, 1);
        Event::assertDispatched(PersistedAffordabilityExpenseReversalEvent::class, 1);
        Event::assertDispatched(PersistedNetworkComminglingTransactionEvent::class, 1);
        Event::assertDispatched(PersistedTDSReimbursementEvent::class, 1);
    }
}

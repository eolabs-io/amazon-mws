<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistRefundEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistShipmentEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistAdjustmentEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistChargebackEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistServiceFeeEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistRetrochargeEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistDebtRecoveryEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistCouponPaymentEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistLoanServicingEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistPayWithAmazonEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistFBALiquidationEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistGuaranteeClaimEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistTDSReimbursementEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistProductAdsPaymentEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistRentalTransactionEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistImagingServicesFeeEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistSAFETReimbursementEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistAffordabilityExpenseEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistServiceProviderCreditEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistAffordabilityExpenseReversalEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistNetworkComminglingTransactionEventAction;
use EolabsIo\AmazonMws\Domain\Finance\Actions\PersistSellerReviewEnrollmentPaymentEventAction;

class PersistFinancialEventAction
{

    /** @var array */
    private $list;

    public function __construct($list)
    {
        $this->list = data_get($list, 'FinancialEvents');
    }

    public function execute()
    {
        $this->createFromList();
    }

    private function createFromList()
    {
        foreach ($this->actions() as $action) {
            (new $action($this->list))->execute();
        }
    }

    private function actions(): array
    {
        return [
            PersistShipmentEventAction::class,
            PersistRefundEventAction::class,
            PersistGuaranteeClaimEventAction::class,
            PersistChargebackEventAction::class,
            PersistPayWithAmazonEventAction::class,
            PersistServiceProviderCreditEventAction::class,
            PersistRetrochargeEventAction::class,
            PersistRentalTransactionEventAction::class,
            // PersistPerformanceBondRefundEventAction::class,
            PersistProductAdsPaymentEventAction::class,
            PersistServiceFeeEventAction::class,
            PersistDebtRecoveryEventAction::class,
            PersistLoanServicingEventAction::class,
            PersistAdjustmentEventAction::class,
            PersistCouponPaymentEventAction::class,
            PersistSAFETReimbursementEventAction::class,
            PersistSellerReviewEnrollmentPaymentEventAction::class,
            PersistFBALiquidationEventAction::class,
            PersistImagingServicesFeeEventAction::class,
            PersistAffordabilityExpenseEventAction::class,
            PersistAffordabilityExpenseReversalEventAction::class,
            PersistNetworkComminglingTransactionEventAction::class,
            PersistTDSReimbursementEventAction::class,
        ];
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

trait HasReportType
{

    /** @var array */
    private $reportTypeParameters = [
        'ReportType' => null,
        'ReportOptions' => null,
    ];

    //------------------------
    // FBA Sales Reports
    //------------------------

    public function withReportTypeFbaAmazonFulfilledShipmentsReport(): self
    {
        $this->withReportType('_GET_AMAZON_FULFILLED_SHIPMENTS_DATA_');
        $this->withoutReportOptions();

        return $this;
    }

    public function withReportTypeFlatFileAllOrdersReportByLastUpdate(): self
    {
        $this->withReportType('_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_');

        return $this;
    }

    public function withReportTypeFlatFileAllOrdersReportByOrderDate(): self
    {
        $this->withReportType('_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_');

        return $this;
    }

    public function withReportTypeXmlAllOrdersReportByLastUpdate(): self
    {
        $this->withReportType('_GET_XML_ALL_ORDERS_DATA_BY_LAST_UPDATE_');

        return $this;
    }

    public function withReportTypeXmlAllOrdersReportByOrderDate(): self
    {
        $this->withReportType('_GET_XML_ALL_ORDERS_DATA_BY_ORDER_DATE_');

        return $this;
    }

    public function withReportTypeFbaCustomerShipmentSalesReport(): self
    {
        $this->withReportType('_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_SALES_DATA_');

        return $this;
    }

    public function withReportTypeFbaPromotionsReport(): self
    {
        $this->withReportType('_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_PROMOTION_DATA_');

        return $this;
    }

    public function withReportTypeFbaCustomerTaxes(): self
    {
        $this->withReportType('_GET_FBA_FULFILLMENT_CUSTOMER_TAXES_DATA_');

        return $this;
    }

    public function withReportTypeRemoteFulfillmentEligibility(): self
    {
        $this->withReportType('_GET_REMOTE_FULFILLMENT_ELIGIBILITY_');

        return $this;
    }

    public function withReportType($type): self
    {
        $this->reportTypeParameters['ReportType'] = $type;

        return $this;
    }

    public function withoutReportOptions(): self
    {
        return $this->withReportOptions();
    }

    public function withReportOptions($options = null): self
    {
        $this->reportTypeParameters['ReportOptions'] = $options;

        return $this;
    }

    public function hasReportType(): bool
    {
        return filled($this->reportTypeParameters['ReportType']);
    }


    public function getReportTypeParameters(): array
    {
        return array_filter($this->reportTypeParameters);
    }
}

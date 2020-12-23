<?php

namespace EolabsIo\AmazonMws\Domain\Reports;

use EolabsIo\AmazonMws\Domain\Reports\ReportCore;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithMaxCount;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithAcknowledged;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithAvailableDate;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportTypeList;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportRequestIdList;

class GetReportList extends ReportCore
{
    use InteractsWithMaxCount,
        InteractsWithReportTypeList,
        InteractsWithAcknowledged,
        InteractsWithReportRequestIdList,
        InteractsWithAvailableDate;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([
            $this->getMaxCountParameter(),
            $this->getReportTypesParameter(),
            $this->getAcknowledged(),
            $this->getReportRequestIdsParameter(),
            $this->getAvailableDateParameter(),
        ]);
    }

    public function getAction(): string
    {
        return ($this->hasNextToken()) ? 'GetReportListByNextToken' : 'GetReportList';
    }
}

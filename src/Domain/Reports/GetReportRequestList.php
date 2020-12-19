<?php

namespace EolabsIo\AmazonMws\Domain\Reports;

use EolabsIo\AmazonMws\Domain\Reports\ReportCore;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithMaxCount;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithRequestedDate;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportTypeList;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportRequestIdList;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportProcessingStatusList;

class GetReportRequestList extends ReportCore
{
    use InteractsWithReportRequestIdList,
        InteractsWithReportTypeList,
        InteractsWithReportProcessingStatusList,
        InteractsWithMaxCount,
        InteractsWithRequestedDate;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([
            $this->getReportRequestIdsParameter(),
            $this->getReportTypesParameter(),
            $this->getProcessingStatusesParameter(),
            $this->getMaxCountParameter(),
            $this->getRequestedDateParameter(),
        ]);
    }

    public function getAction(): string
    {
        return ($this->hasNextToken()) ? 'GetReportRequestListByNextToken' : 'GetReportRequestList';
    }
}

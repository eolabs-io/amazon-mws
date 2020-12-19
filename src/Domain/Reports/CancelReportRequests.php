<?php

namespace EolabsIo\AmazonMws\Domain\Reports;

use EolabsIo\AmazonMws\Domain\Reports\ReportCore;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithRequestedDate;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportTypeList;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportRequestIdList;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportProcessingStatusList;

class CancelReportRequests extends ReportCore
{
    use InteractsWithReportRequestIdList,
        InteractsWithReportTypeList,
        InteractsWithReportProcessingStatusList,
        InteractsWithRequestedDate;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([
            $this->getReportRequestIdsParameter(),
            $this->getReportTypesParameter(),
            $this->getProcessingStatusesParameter(),
            $this->getRequestedDateParameter(),
        ]);
    }

    public function getAction(): string
    {
        return 'CancelReportRequests';
    }
}

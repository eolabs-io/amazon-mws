<?php

namespace EolabsIo\AmazonMws\Domain\Reports;

use EolabsIo\AmazonMws\Domain\Reports\ReportCore;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithRequestedDate;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportTypeList;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportProcessingStatusList;

class GetReportRequestCount extends ReportCore
{
    use InteractsWithReportTypeList,
        InteractsWithReportProcessingStatusList,
        InteractsWithRequestedDate;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([
            $this->getReportTypesParameter(),
            $this->getProcessingStatusesParameter(),
            $this->getRequestedDateParameter(),
        ]);
    }

    public function getAction(): string
    {
        return 'GetReportRequestCount';
    }
}

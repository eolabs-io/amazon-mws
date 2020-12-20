<?php

namespace EolabsIo\AmazonMws\Domain\Reports;

use EolabsIo\AmazonMws\Domain\Reports\ReportCore;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\HasReportType;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportTimeFrames;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\InteractsWithMarketplaceIdList;

class RequestReport extends ReportCore
{
    use HasReportType,
        InteractsWithReportTimeFrames,
        InteractsWithMarketplaceIdList;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([
            $this->getReportTypeParameters(),
            $this->getPostedTimeFrameParameter(),
            $this->getMarketplaceIdListParameter(),
        ]);
    }

    public function getAction(): string
    {
        return 'RequestReport';
    }
}

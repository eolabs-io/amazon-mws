<?php

namespace EolabsIo\AmazonMws\Domain\Reports;

use EolabsIo\AmazonMws\Domain\Reports\ReportCore;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\HasReportType;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\InteractsWithMarketplaceIds;
use EolabsIo\AmazonMws\Domain\Reports\Concerns\InteractsWithReportTimeFrames;

class RequestReport extends ReportCore
{
    use HasReportType,
        InteractsWithReportTimeFrames,
        InteractsWithMarketplaceIds;


    public function resolveOptionalParameters(): void
    {
        $this->mergeParameters([
            $this->getReportTypeParameters(),
            $this->getPostedTimeFrameParameter(),
            $this->getMarketplaceIdsParameter(),
        ]);
    }

    public function getAction(): string
    {
        return 'RequestReport';
    }
}

<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

trait InteractsWithReportId
{
    /** @var string */
    private $reportId = [];

    public function withReportId(string $reportId): self
    {
        $this->reportId = $reportId;

        return $this;
    }

    public function getReportId(): string
    {
        return $this->reportId;
    }

    public function getReportIdParameter(): array
    {
        return ['ReportId' => $this->getReportId()];
    }
}

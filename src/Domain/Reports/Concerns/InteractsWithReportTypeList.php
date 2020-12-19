<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

trait InteractsWithReportTypeList
{
    /** @var array */
    private $reportTypes = [];

    public function withReportTypes(array $reportTypes): self
    {
        $this->reportTypes = $reportTypes;

        return $this;
    }

    public function hasReportTypes(): bool
    {
        return count($this->reportTypes) > 0;
    }

    public function getReportTypes(): array
    {
        return $this->reportTypes;
    }

    public function formattedReportTypes(): array
    {
        return collect($this->getReportTypes())->mapWithKeys(function ($item, $key) {
            $key++;
            return ["ReportTypeList.Type.{$key}" => $item ];
        })->toArray();
    }

    public function getReportTypesParameter(): array
    {
        return $this->formattedReportTypes();
    }
}

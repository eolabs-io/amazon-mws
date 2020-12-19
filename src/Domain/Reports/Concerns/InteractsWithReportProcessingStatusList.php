<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

trait InteractsWithReportProcessingStatusList
{
    /** @var array */
    private $processingStatuses = [];

    public function withReportProcessingStatuses(array $processingStatuses): self
    {
        $this->processingStatuses = $processingStatuses;

        return $this;
    }

    public function hasProcessingStatuses(): bool
    {
        return count($this->processingStatuses) > 0;
    }

    public function getProcessingStatuses(): array
    {
        return $this->processingStatuses;
    }

    public function formattedProcessingStatuses(): array
    {
        return collect($this->getProcessingStatuses())->mapWithKeys(function ($item, $key) {
            $key++;
            return ["ReportProcessingStatusList.Status.{$key}" => $item ];
        })->toArray();
    }

    public function getProcessingStatusesParameter(): array
    {
        return $this->formattedProcessingStatuses();
    }
}

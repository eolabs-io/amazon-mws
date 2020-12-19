<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

trait InteractsWithReportRequestIdList
{
    /** @var array */
    private $requestIds = [];

    public function withReportRequestIds(array $requestIds): self
    {
        $this->requestIds = $requestIds;

        return $this;
    }

    public function hasReportRequestIds(): bool
    {
        return count($this->requestIds) > 0;
    }

    public function getReportRequestIds(): array
    {
        return $this->requestIds;
    }

    public function formattedReportRequestIds(): array
    {
        return collect($this->getReportRequestIds())->mapWithKeys(function ($item, $key) {
            $key++;
            return ["ReportRequestIdList.Id.{$key}" => $item ];
        })->toArray();
    }

    public function getReportRequestIdsParameter(): array
    {
        return $this->formattedReportRequestIds();
    }
}

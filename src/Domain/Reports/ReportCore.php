<?php

namespace EolabsIo\AmazonMws\Domain\Reports;

use EolabsIo\AmazonMws\Domain\Shared\AmazonCore;

abstract class ReportCore extends AmazonCore
{
    public function getBranchUrl(): string
    {
        return "Reports/". $this->getVersion();
    }

    public function getTypeAccessor(): string
    {
        return 'Reports';
    }
}

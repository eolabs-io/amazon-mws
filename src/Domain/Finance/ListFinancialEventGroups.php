<?php

namespace EolabsIo\AmazonMws\Domain\Finance;

use EolabsIo\AmazonMws\Domain\Finance\Concerns\InteractsWithFinancialEventGroupStartedTimeFrames;
use EolabsIo\AmazonMws\Domain\Finance\FinanceCore;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\InteractsWithMaxResultsPerPage;


class ListFinancialEventGroups extends FinanceCore
{
	use InteractsWithFinancialEventGroupStartedTimeFrames, 
	    InteractsWithMaxResultsPerPage;


	public function resolveOptionalParameters(): void
	{
		$this->mergeParameters( [$this->getFinancialEventGroupStartedTimeFrameParameter(),
								 $this->getMaxResultsPerPageParameter(),
								 ]
		);
	}

	public function getAction(): string
	{
		return ($this->hasNextToken()) ? 'ListFinancialEventGroupsByNextToken' : 'ListFinancialEventGroups';
	}

}

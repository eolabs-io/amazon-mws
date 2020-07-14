<?php

namespace EolabsIo\AmazonMws\Domain\Finance;

use EolabsIo\AmazonMws\Domain\Finance\Concerns\InteractsFinancialEventGroupId;
use EolabsIo\AmazonMws\Domain\Finance\Concerns\InteractsWithPostedTimeFrames;
use EolabsIo\AmazonMws\Domain\Finance\FinanceCore;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\InteractsWithAmazonOrderId;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\InteractsWithMaxResultsPerPage;


class ListFinancialEvents extends FinanceCore
{
	use InteractsWithMaxResultsPerPage,
		InteractsWithAmazonOrderId, 
	    InteractsFinancialEventGroupId,
	    InteractsWithPostedTimeFrames;


	public function resolveOptionalParameters(): void
	{
		$this->mergeParameters( [$this->getAmazonOrderIdParameter(),
								 $this->getMaxResultsPerPageParameter(),
								 $this->getFinancialEventGroupIdParameter(),
								 $this->getPostedTimeFrameParameter(),
								 ]
		);
	}

	public function getAction(): string
	{
		return ($this->hasNextToken()) ? 'ListFinancialEventsByNextToken' : 'ListFinancialEvents';
	}

}

<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;

trait InteractsWithMaxResultsPerPage
{
	/** @var integer */
	private $maxResultsPerPage = null;

    public function withMaxResultsPerPage(int $maxResultsPerPage): self
    {
    	if($maxResultsPerPage < 1) {
    		$maxResultsPerPage = 1;
    	}

    	if($maxResultsPerPage > 100) {
    		$maxResultsPerPage = 100;
    	}

        $this->maxResultsPerPage = $maxResultsPerPage;

        return $this;
    }

    public function hasMaxResultsPerPage(): bool
    {
        return ! is_null($this->maxResultsPerPage);
    }

    public function getMaxResultsPerPage(): int
    {
        return $this->maxResultsPerPage;
    }
    
    public function getMaxResultsPerPageParameter(): array
    {
        if(! $this->hasMaxResultsPerPage()){
            return [];
        }

        return ['MaxResultsPerPage' => $this->getMaxResultsPerPage()];
    }
}
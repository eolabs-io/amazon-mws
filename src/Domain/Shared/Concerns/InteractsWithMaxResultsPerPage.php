<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Concerns;

trait InteractsWithMaxResultsPerPage
{
	/** @var integer */
	private $maxResultsPerPage = null;

    public function withMaxResultsPerPage(int $maxResultsPerPage): self
    {
        $minResultsPerPageAllowed = $this->getMinResultsPerPageAllowed();
        $maxResultsPerPageAllowed = $this->getMaxResultsPerPageAllowed();

    	if($maxResultsPerPage < $minResultsPerPageAllowed) {
    		$maxResultsPerPage = $minResultsPerPageAllowed;
    	}

    	if($maxResultsPerPage > $maxResultsPerPageAllowed) {
    		$maxResultsPerPage = $maxResultsPerPageAllowed;
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

    public function getMaxResultsPerPageAllowed(): int
    {
        return 100;
    }
   
    public function getMinResultsPerPageAllowed(): int
    {
        return 1;
    }

    public function getMaxResultsPerPageParameter(): array
    {
        if(! $this->hasMaxResultsPerPage()){
            return [];
        }

        return ['MaxResultsPerPage' => $this->getMaxResultsPerPage()];
    }
}
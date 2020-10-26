<?php

namespace EolabsIo\AmazonMws\Domain\Reviews;

use Illuminate\Support\Collection;
use EolabsIo\AmazonMws\Domain\Reviews\ReviewCore;

class GetProductReview extends ReviewCore
{
    private $pageNumber;
    private $reviewsPerPage = 10;

    public function fetch(): Collection
    {
        return parent::fetch()->merge([
                'pageNumber' => $this->getPageNumber(),
                'nextPage' => $this->nextPage(),
                'totalNumberOfPages' => $this->totalNumberOfPages(),
            ]);
    }

    public function withPageNumber($pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    public function getPageNumber()
    {
        return $this->pageNumber ?? 1;
    }

    public function getQueryParameters(): array
    {
        return ['pageNumber' => $this->getPageNumber()];
    }

    public function hasNextPage(): bool
    {
        return $this->nextPage() > 1;
    }

    public function nextPage()
    {
        $currentPageNumber = $this->getPageNumber();
        $totalNumberOfPages = $this->totalNumberOfPages();

        return ($currentPageNumber < $totalNumberOfPages)
            ? $currentPageNumber + 1
            : null;
    }

    public function totalNumberOfPages(): int
    {
        $parsedResponse = $this->getParsedResponse();
        $numberOfReviews = $parsedResponse['numberOfReviews'];
        return ceil($numberOfReviews / $this->reviewsPerPage);
    }
}

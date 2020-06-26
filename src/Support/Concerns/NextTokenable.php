<?php

namespace EolabsIo\AmazonMws\Support\Concerns;

use Illuminate\Support\Collection;

trait NextTokenable
{
    /** @var string */
    private $nextToken;


    public function checkForToken(Collection $results): self
    {
        $token = $results->get('NextToken');
        $this->setNextToken($token);

        return $this;
    }

    public function clearNextToken(): self
    {
        $this->setNextToken();

        return $this;
    }

    public function getNextToken(): ?string
    {
        return $this->nextToken;
    }

    public function setNextToken(string $nextToken = null): self
    {
        $this->nextToken = $nextToken;

        return $this;
    }

    public function hasNextToken(): bool
    {
        return filled($this->getNextToken());
    }  

    public function getNextTokenParameter(): array
    {
        return ['NextToken' => $this->getNextToken()];
    }
}
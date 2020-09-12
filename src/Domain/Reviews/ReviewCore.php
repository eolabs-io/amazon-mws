<?php

namespace EolabsIo\AmazonMws\Domain\Reviews;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

abstract class ReviewCore
{
    public function fetch(): Collection
    {
        $response = Http::get($this->getUrl());
        $parsedResponse = $this->parseResponse($response);

        return $parsedResponse;
    }

    abstract public function parseResponse($response): Collection;

    abstract public function getUrl(): string;

    public function getBaseUrl(): string
    {
        return 'https://www.amazon.com';
    }
}

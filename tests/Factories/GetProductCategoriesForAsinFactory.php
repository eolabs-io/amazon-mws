<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use Illuminate\Support\Facades\Http;

class GetProductCategoriesForAsinFactory
{
    private $endpoint = 'mws.amazonservices.com/Products/2011-10-01';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakeResponse(): self
    {
        $file = __DIR__ . '/../Stubs/Responses/fetchGetProductCategoriesForASIN.xml';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }
}

<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use EolabsIo\AmazonMwsClient\Models\Endpoint;
use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Models\Participation;
use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Tests\Factories\BaseFactory;

class StoreFactory extends BaseFactory
{
    /** @var array */
    private $attributes = [];

    /** @var array */
    private $marketplaces = [];


    public function create(array $extra = []): Store
    {
        $attributes = array_merge($this->attributes, $extra);

        $store = Store::factory()->create($attributes);

        foreach ($this->marketplaces as $marketplace) {
            Participation::factory()->create([
                                                    'marketplace_id' => $marketplace->marketplace_id,
                                                    'seller_id' => $store->seller_id,
                                                ]);
        }

        // $store->marketplaces()->attach($this->marketplaces);

        return $store;
    }

    public function withDefaultMarketplaces(): self
    {
        $endpoint = Endpoint::where(['country_code' => 'US'])->first();
        $this->marketplaces[] = Marketplace::factory()->create(['marketplace_id' => $endpoint->marketplace_id]);

        return $this;
    }

    public function withValidAttributes(): self
    {
        $this->attributes = $this->validAttributes();

        return $this;
    }

    private function validAttributes()
    {
        return [
            'amazon_service_url' => 'https://mws.amazonservices.com',
            'secret_key' => 'z26+XNDLWnGqALtHOf9NtN2r17fe9EL29EXAMPLE',
            'aws_access_key_id' => '0PB842EXAMPLE7N4ZTR2',
            'mws_auth_token' => 'amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE',
            'seller_id' => 'A2NEXAMPLETF53',
        ];
    }
}

<?php

namespace EolabsIo\AmazonMws\Tests\Feature\Seller;

use EolabsIo\AmazonMwsClient\Models\Marketplace;
use EolabsIo\AmazonMwsClient\Models\Participation;
use EolabsIo\AmazonMws\Domain\Sellers\Jobs\ProcessListMarketplaceParticipationsResponse;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListMarketplaceParticipations;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProcessListMarketplaceParticipationsResponseTest extends TestCase
{
    use RefreshDatabase,
        CreatesListMarketplaceParticipations;

    /** @var EolabsIo\AmazonMws\Support\Facades\ListMarketplaceParticipations; */
    public $listMarketplaceParticipations;

    /** @var Illuminate\Support\Collection */
    public $results;

    protected function setUp(): void
    {
        parent::setUp();

        $this->executeListMarketplaceParticipationsResponse();
    }

    /** @test */
    public function it_can_process_product_response()
    {
        $marketplace = Marketplace::first();
        $this->assertSeesMarketplace($marketplace);

        $participation = Participation::first();
        $this->assertSeesParticipation($participation);
    }

    /** @test */
    public function it_can_update_product_response()
    {
        (new ProcessListMarketplaceParticipationsResponse($this->results))->handle();
        
        $this->assertDatabaseCount('marketplaces', 1);
        $this->assertDatabaseCount('participations', 1);
    }

    public function assertSeesMarketplace($marketplace)
    {
        $this->assertEquals($marketplace->marketplace_id, "ATVPDKIKX0DER");
        $this->assertEquals($marketplace->name, "Amazon.com");
        $this->assertEquals($marketplace->default_country_code, "US");
        $this->assertEquals($marketplace->default_currency_code, "USD");
        $this->assertEquals($marketplace->default_language_code, "en_US");
        $this->assertEquals($marketplace->domain_name, "www.amazon.com");
    }

    public function assertSeesParticipation($participation)
    {
        $this->assertEquals($participation->marketplace_id, "ATVPDKIKX0DER");
        $this->assertEquals($participation->seller_id, "A135KKEKJAIBJ56");
        $this->assertEquals($participation->has_seller_suspended_listings, "No");
    }


    public function executeListMarketplaceParticipationsResponse()
    {
        $this->listMarketplaceParticipations = $this->createlistMarketplaceParticipations();

        $this->results = $this->listMarketplaceParticipations->fetch();

        (new ProcessListMarketplaceParticipationsResponse($this->results))->handle();
    }

}
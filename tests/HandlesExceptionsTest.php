<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\AccessDeniedException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InputStreamDisconnectedException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InternalErrorException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InvalidAccessKeyIdException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InvalidAddressException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\InvalidParameterValueException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\QuotaExceededException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\RequestThrottledException;
use EolabsIo\AmazonMws\Domain\Shared\Exceptions\SignatureDoesNotMatchException;
use EolabsIo\AmazonMws\Support\Facades\InventoryList;
use EolabsIo\AmazonMws\Tests\Factories\InventoryFactory;
use EolabsIo\AmazonMws\Tests\Factories\StoreFactory;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class HandlesExceptionsTest extends TestCase
{
    public $store;

    protected function setUp(): void
    {
        parent::setUp();

        $this->store = StoreFactory::new()
                         ->withValidAttributes()
                         ->create();
    }

    /** @test */
    public function it_throws_input_stream_disconnected_exception()
    {
        $this->expectException(InputStreamDisconnectedException::class);

    	InventoryFactory::new()->fakeInputStreamDisconnectedErrorResponse();

        $response = InventoryList::withStore($this->store)->fetch();
    }

    /** @test */
    public function it_throws_invalid_parameter_value_exception()
    {
        $this->expectException(InvalidParameterValueException::class);

        InventoryFactory::new()->fakeInvalidParameterValueErrorResponse();

        $response = InventoryList::withStore($this->store)->fetch();
    }

    /** @test */
    public function it_throws_access_denied_error_exception()
    {
        $this->expectException(AccessDeniedException::class);

        InventoryFactory::new()->fakeAccessDeniedErrorResponse();

        $response = InventoryList::withStore($this->store)->fetch();
    }

    /** @test */
    public function it_throws_invalid_access_key_id_exception()
    {
        $this->expectException(InvalidAccessKeyIdException::class);

        InventoryFactory::new()->fakeInvalidAccessKeyIdErrorResponse();

        $response = InventoryList::withStore($this->store)->fetch();
    }

    /** @test */
    public function it_throws_signature_does_not_match_exception()
    {
        $this->expectException(SignatureDoesNotMatchException::class);

        InventoryFactory::new()->fakeSignatureDoesNotMatchErrorResponse();

        $response = InventoryList::withStore($this->store)->fetch();
    }

    /** @test */
    public function it_throws_invalid_address_exception()
    {
        $this->expectException(InvalidAddressException::class);

        InventoryFactory::new()->fakeInvalidAddressErrorResponse();

        $response = InventoryList::withStore($this->store)->fetch();
    }

    /** @test */
    public function it_throws_internal_error_exception()
    {
        $this->expectException(InternalErrorException::class);

        InventoryFactory::new()->fakeInternalErrorResponse();

        $response = InventoryList::withStore($this->store)->fetch();
    }

    /** @test */
    public function it_throws_quota_exceeded_exception()
    {
        $this->expectException(QuotaExceededException::class);

        InventoryFactory::new()->fakeQuotaExceededErrorResponse();

        $response = InventoryList::withStore($this->store)->fetch();
    }

    /** @test */
    public function it_throws_request_throttled_exception()
    {
        $this->expectException(RequestThrottledException::class);

        InventoryFactory::new()->fakeRequestThrottledErrorResponse();

        $response = InventoryList::withStore($this->store)->fetch();
    }
}
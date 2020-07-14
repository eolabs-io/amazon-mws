<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMws\Domain\Finance\Jobs\ProcessListFinancialEventGroupsResponse;
use EolabsIo\AmazonMws\Domain\Finance\Models\FinancialEventGroup;
use EolabsIo\AmazonMws\Tests\Concerns\CreatesListFinancialEventGroup;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProcessListFinancialEventGroupsResponseTest extends TestCase
{

    use RefreshDatabase,
        CreatesListFinancialEventGroup;


    protected function setUp(): void
    {
        parent::setUp();
        
        $listOrders = $this->createListFinancialEventGroup();

        $results = $listOrders->fetch();

        (new ProcessListFinancialEventGroupsResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_list_financial_event_groups_response()
    {
        $financialEventGroup = FinancialEventGroup::with('originalTotal')
                                                  ->where(["financial_event_group_id" => "22YgYW55IGNhcm5hbCBwbGVhEXAMPLE"])
                                                  ->first();

        $this->assertEquals($financialEventGroup->processing_status, "Closed");
        $this->assertEquals($financialEventGroup->fund_transfer_status, "Successful");
        $this->assertEquals($financialEventGroup->originalTotal->amount, 19.00);
        $this->assertEquals($financialEventGroup->originalTotal->currency_code, "USD");
        
    }

}
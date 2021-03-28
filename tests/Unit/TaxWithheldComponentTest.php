<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;

class TaxWithheldComponentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TaxWithheldComponent::class;
    }

    /** @test */
    public function it_has_taxesWithheld_relationship()
    {
        $taxWithheldComponent = TaxWithheldComponent::factory()->create();
        $chargeComponents = ChargeComponent::factory()->times(5)->create();

        $taxWithheldComponent->taxesWithheld()->toggle($chargeComponents);

        $this->assertArraysEqual($chargeComponents->toArray(), $taxWithheldComponent->taxesWithheld->toArray());
    }
}

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
        $taxWithheldComponent = factory(TaxWithheldComponent::class)->create();
        $chargeComponents = factory(ChargeComponent::class, 5)->create();

        $taxWithheldComponent->taxesWithheld()->toggle($chargeComponents);

        $this->assertArraysEqual($chargeComponents->toArray(), $taxWithheldComponent->taxesWithheld->toArray());
    }
}

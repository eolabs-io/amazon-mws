<?php
 
namespace EolabsIo\AmazonMws\Domain\Sellers\Events;

use EolabsIo\AmazonMws\Domain\Sellers\ListMarketplaceParticipations;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class FetchListMarketplaceParticipations
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\AmazonMws\Domain\Sellers\ListMarketplaceParticipations */
    public $listMarketplaceParticipations;

    public function __construct(ListMarketplaceParticipations $listMarketplaceParticipations)
    {
        $this->listMarketplaceParticipations = $listMarketplaceParticipations;
    }
}
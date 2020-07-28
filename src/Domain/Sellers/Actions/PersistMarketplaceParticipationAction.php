<?php

namespace EolabsIo\AmazonMws\Domain\Sellers\Actions;

use EolabsIo\AmazonMws\Domain\Sellers\Actions\PersistMarketplaceAction;
use EolabsIo\AmazonMws\Domain\Sellers\Actions\PersistParticipationAction;


class PersistMarketplaceParticipationAction
{
    /** @var array */
    private $list;

    public function __construct($list)
    {   
        $this->list = $list;
    }

    public function execute()
    {
        foreach($this->associateActions() as $associateActions) {
        	(new $associateActions($this->list))->execute();
        }
    }

    protected function associateActions(): array
    {
    	return [
            PersistMarketplaceAction::class,
            PersistParticipationAction::class,
    	];
    }
}
<?php

namespace EolabsIo\AmazonMws\Support\Concerns;

use EolabsIo\AmazonMwsClient\Models\Store;

trait HasStoreInteractions
{
    /** @var EolabsIo\AmazonMwsClient\Models\Store */
    private $store;

    public function withStore(Store $store): self
    {
        $this->store = $store;

        return $this;
    }

    protected function getStore(): Store
    {
        return $this->store;
    }

    public function getStoreId()
    {
        return $this->store->id;
    }
}

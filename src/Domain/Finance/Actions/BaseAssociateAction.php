<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


abstract class BaseAssociateAction 
{
    use FormatsModelAttributes;

    /** @var array */
    protected $list;

    protected $model;

    public function __construct($list)
    {
        $key = $this->getKey();
        $this->list = data_get($list, $key, []);
    }

    abstract public function getKey(): string;

    public function execute($model)
    {
        $this->model = $model;
        $this->createFromList();
    }
    
    private function createFromList()
    {
        $this->createItem($this->list);
    }

    abstract protected function createItem($list);

}
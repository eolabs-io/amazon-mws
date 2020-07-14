<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Actions;

use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;


abstract class BasePersistAction 
{
	use FormatsModelAttributes;
	
    /** @var array */
    private $list;

    public function __construct($list)
    {
        $key = $this->getKey();
        $this->list = data_get($list, $key, []);
    }

     abstract public function getKey(): string;

    public function execute()
    {
        $this->createFromList();
    }
    
    private function createFromList()
    {
        foreach($this->list as $value) {
            $this->createItem($value);
        }
    }

    abstract protected function createItem($list);

}
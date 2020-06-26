<?php

namespace EolabsIo\AmazonMws\Tests\Factories;

use EolabsIo\AmazonMws\Tests\Factories\Contracts\FactoryInterface;


abstract class BaseFactory implements FactoryInterface
{

    public static function new(): self
    {
        return new static();
    }

}
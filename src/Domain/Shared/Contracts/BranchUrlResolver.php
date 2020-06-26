<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Contracts;


interface BranchUrlResolver
{

    public function getBranchUrl(): string;

}
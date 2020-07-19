<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Exceptions;

use Illuminate\Http\Client\RequestException;


class SignatureDoesNotMatchException extends RequestException
{

}
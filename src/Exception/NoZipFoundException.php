<?php

namespace GerZippy\Exception;

use Throwable;

class NoZipFoundException extends \Exception
{
    public function __construct(string $zip)
    {
        parent::__construct(sprintf("The given zip %s was not found.", $zip));
    }

}

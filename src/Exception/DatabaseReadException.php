<?php

namespace GerZippy\Exception;

use Throwable;

class DatabaseReadException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Not able to open zip database csv.");
    }

}

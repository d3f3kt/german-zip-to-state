<?php

namespace GerZippy;

use GerZippy\Exception\DatabaseReadException;
use GerZippy\Exception\NoZipFoundException;

class ZipResolver implements ZipResolverInterface
{
    /** @var resource */
    private $zipFileHandle;

    public function __construct()
    {
        $this->zipFileHandle = fopen(__DIR__.'/../Resources/zips.csv', 'r');
        if (!is_resource($this->zipFileHandle)) {
            throw new DatabaseReadException();
        }
    }

    public function __destruct()
    {
        fclose($this->zipFileHandle);
    }


    public function resolveZip(string $zip): Zip
    {
        rewind($this->zipFileHandle);
        while (($data = fgetcsv($this->zipFileHandle)) !== false) {
            if ($data[2] == $zip) {
                return $this->createZipModel($data);
            }
        }

        throw new NoZipFoundException($zip);
    }

    private function createZipModel($data): Zip
    {
        return new Zip($data[2], $data[1], $data[3]);
    }
}

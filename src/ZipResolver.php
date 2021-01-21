<?php

namespace GerZippy;

use GerZippy\Exception\DatabaseReadException;
use GerZippy\Exception\NoZipFoundException;

class ZipResolver implements ZipResolverInterface
{
    /**
     * [zip => [city, state], ...]
     *
     * @var array[]
     */
    private $zips;

    public function resolveZip(string $zip): Zip
    {
        if(null === $this->zips) {
            $this->loadZips();
        }

        if(!array_key_exists($zip, $this->zips)) {
            throw new NoZipFoundException($zip);
        }

        return $this->createZipModel($zip, $this->zips[$zip]);

    }

    private function createZipModel(string $zip, array $data): Zip
    {
        return new Zip($zip, $data[0], $data[1]);
    }

    private function loadZips()
    {
        $this->zips = [];
        $zipFileHandle = fopen(__DIR__.'/../Resources/zips.csv', 'r');

        while (($data = fgetcsv($zipFileHandle)) !== false) {
            $this->zips[$data[1]] = [$data[0], $data[2]];
        }
        if (!is_resource($zipFileHandle)) {
            throw new DatabaseReadException();
        }
        fclose($zipFileHandle);

    }
}

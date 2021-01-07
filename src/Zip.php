<?php

namespace GerZippy;

class Zip
{
    /** @var string */
    private $zip;
    /** @var string */
    private $city;
    /** @var string */
    private $state;

    public function __construct(string $zip, string $city, string $state)
    {
        $this->zip = $zip;
        $this->city = $city;
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

}

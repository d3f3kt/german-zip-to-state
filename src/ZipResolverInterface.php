<?php

namespace GerZippy;

interface ZipResolverInterface
{
    public function resolveZip(string $zip): Zip;

}

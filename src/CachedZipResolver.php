<?php

namespace GerZippy;

class CachedZipResolver implements ZipResolverInterface
{
    /** @var ZipResolver  */
    private $zipResolver;
    /** @var array|Zip[] */
    private $cache;

    private const CACHE_SIZE = 150;

    public function __construct(ZipResolver $resolver)
    {
        $this->zipResolver = $resolver;
        $this->cache = [];
    }

    public function resolveZip(string $zip): Zip
    {
        if(array_key_exists($zip, $this->cache)) {
            return $this->cache[$zip];
        }

        $zipModel = $this->zipResolver->resolveZip($zip);
        $this->refreshCache($zipModel);

        return $zipModel;
    }

    private function refreshCache(Zip $zip): void
    {
        if(count($this->cache) > self::CACHE_SIZE) {
            $keys = array_keys($this->cache);
            unset($this->cache[$keys[0]]);
        }

        $this->cache[$zip->getZip()] = $zip;
    }
}

<?php

namespace AppBundle\Cache;

class NaiveCache implements Cache
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getKey($object)
    {
        return md5(serialize($object));
    }

    public function get($key)
    {
        $filename = $this->path."/".$key;
        if (file_exists($filename)) {
            $fileContent = file_get_contents($filename);
            return unserialize($fileContent);
        }
        return null;
    }

    public function set($key, $object, $ttl)
    {
        file_put_contents($this->path . "/" . $key, serialize($object));
    }

    public function delete($key)
    {
        $filename = $this->path."/".$key;
        if (file_exists($filename)) {
            unlink($filename);
        }
    }
}
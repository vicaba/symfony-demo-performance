<?php

namespace AppBundle\Cache;

interface Cache
{
    public function getKey($object);
    public function get($key);
    public function set($key, $object, $ttl);
    public function delete($key);
}
<?php

namespace AppBundle\Cache;

use Predis\Client;

class RedisCache implements Cache
{
    private $redis;

    public function __construct()
    {
        $this->redis = new Client("tcp://127.0.0.1:6379");
    }

    public function getKey($object)
    {
        return md5(serialize($object));
    }

    public function get($key)
    {
        $result = $this->redis->get($key);
        if($result === "-2") {
            return false;
        }
        return unserialize($result);
    }

    public function set($key, $object, $ttl = null)
    {
        $this->redis->set($key, serialize($object));
        if (!isset($ttl)) {
            return;
        }
        $this->redis->expire($key,$ttl);
    }

    public function delete($key)
    {
        $this->redis->del($key);
    }
}
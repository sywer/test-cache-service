<?php

namespace Sywer\CacheService;

class CacheService
{
    /** @var \Sywer\CacheService\Driver\AbstractDriver  $driver */
    protected $driver;

    public function __construct()
    {
       $config        = require(__DIR__ . '/../config.php');
       $this->driver  = new $config['default_driver'];
    }

    /**
     * @return \Sywer\CacheService\Object\CacheObject|null
     */
    public function getData($key)
    {
        /** @var \Sywer\CacheService\Object\CacheObject $cache */
        $cache = $this->driver->getCache($key);

        return $cache ?: null;
    }

    /**
     * @param string $data
     * 
     * @return \Sywer\CacheService\Object\CacheObject
     */
    public function setData($key, $data, $lifetime)
    {
        $cache = $this->driver->setCache($key, $data, $lifetime);
        return $cache;
    }
}
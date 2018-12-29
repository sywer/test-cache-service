<?php

namespace Sywer\CacheService\Driver;

abstract class AbstractDriver
{
    public abstract function getCache(string $key);

    public abstract function setCache(string $key, string $data, int $lifetime);

}
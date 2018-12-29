<?php

namespace Sywer\CacheService\Driver;

interface DatabaseDriverInterface
{
    public function getConnection();
}
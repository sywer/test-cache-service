<?php

namespace Sywer\CacheService\Driver;

class FileDriver extends AbstractDriver
{
    /**
     * @param string $key
     *
     * @return \Sywer\CacheService\Object\CacheObject|null
     */
    public function getCache($key)
    {
        $file = $this->getFileByKey($key);

        if(file_exists($file))
        {
            $cache = new \Sywer\CacheService\Object\CacheObject();
            $cache->setData(file_get_contents($file));
            $cache->setLifetime($this->getLifetimeByKey($key));
            $cache->setDatetime(new \DateTime(date ("F d Y H:i:s.", filemtime($file))));

            return $cache;
        }

        return null;
    }

    /**
     * @param string $data
     *
     * @return null
     */
    public function setCache($key, $data, $lifetime)
    {
        file_put_contents($this->getFileByKey($key), $data);
        file_put_contents($this->getFileByKey($key).'.lifetime', $lifetime);
        return $this->getCache($key);
    }

    /**
     * @return string
     */
    protected function getCachePath()
    {
        return __DIR__. '/../../var/cache/';
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected function getFileByKey($key)
    {
        return $this->getCachePath() . $key;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected function getLifetimeByKey($key)
    {
        if(file_exists($this->getCachePath() . $key . '.lifetime'))
        {
            return intval(file_get_contents($this->getCachePath() . $key . '.lifetime'));
        }

        return 0;
    }
}
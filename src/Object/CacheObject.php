<?php

namespace Sywer\CacheService\Object;

class CacheObject
{
    /**
     * @var \DateTime
     */
    protected $datetime;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var int
     */
    protected $lifetime;
    
    /**
     * @return \DateTime
     */
    public function getDatetime(): ?\DateTime
    {
        return $this->datetime;
    }

    /**
     * @param \DateTime $datetime
     *
     * @return CacheObject
     */
    public function setDatetime(\DateTime $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * @return string
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @param string $data
     *
     * @return CacheObject
     */
    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return int
     */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    /**
     * @param int $lifetime
     *
     * @return CacheObject
     */
    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;

        return $this;
    }

    /**
     * @return bool
     */
    public function isExpired(): ?bool
    {
        $expirationDatetime = clone $this->datetime;
        $expirationDatetime ->modify('+ '.$this->lifetime . ' seconds');
        $nowDatetime        = new \DateTime();

        if($nowDatetime >= $expirationDatetime)
        {
            return true;
        }

        return false;
    }
}
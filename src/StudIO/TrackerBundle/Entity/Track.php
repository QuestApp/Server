<?php

namespace StudIO\TrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Track
 */
class Track
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $ident;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $latlong;

    /**
     * @var \DateTime
     */
    private $timestamp;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ident
     *
     * @param string $ident
     * @return Track
     */
    public function setIdent($ident)
    {
        $this->ident = $ident;

        return $this;
    }

    /**
     * Get ident
     *
     * @return string 
     */
    public function getIdent()
    {
        return $this->ident;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Track
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set latlong
     *
     * @param string $latlong
     * @return Track
     */
    public function setLatlong($latlong)
    {
        $this->latlong = $latlong;

        return $this;
    }

    /**
     * Get latlong
     *
     * @return string 
     */
    public function getLatlong()
    {
        return $this->latlong;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Track
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}

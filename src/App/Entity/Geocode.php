<?php

namespace App\Entity;

use App\Entity\Internal\Point;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Entity\GeocodeRepository")
 * @ORM\Table(name="geocodes")
 */
class Geocode
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var Brewery
     *
     * @ORM\OneToOne(targetEntity="Brewery", inversedBy="geocode")
     * @ORM\JoinColumn(name="brewery_id", referencedColumnName="id")
     */
    private $brewery;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=17, scale=14)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=17, scale=14)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(length=24)
     */
    private $accuracy;

    /**
     * @var float
     */
    private $distance;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Brewery $brewery
     *
     * @return Geocode
     */
    public function setBrewery(Brewery $brewery)
    {
        $this->brewery = $brewery;

        return $this;
    }

    /**
     * @return Brewery
     */
    public function getBrewery()
    {
        return $this->brewery;
    }

    /**
     * @param string $latitude
     *
     * @return Geocode
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $longitude
     *
     * @return Geocode
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return array
     */
    public function getCoordinates()
    {
        return [$this->getLatitude(), $this->getLongitude()];
    }

    /**
     * @return Point
     */
    public function getPoint()
    {
        return new Point($this->getLatitude(), $this->getLongitude());
    }

    /**
     * @param string $accuracy
     *
     * @return Geocode
     */
    public function setAccuracy($accuracy)
    {
        $this->accuracy = $accuracy;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccuracy()
    {
        return $this->accuracy;
    }

    /**
     * @param float $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }
}

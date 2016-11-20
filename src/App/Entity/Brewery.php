<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="breweries")
 */
class Brewery
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
     * @var string
     *
     * @ORM\Column(length=128)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(length=128)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(length=128)
     */
    private $country;

    /**
     * @ORM\OneToOne(targetEntity="Geocode", mappedBy="brewery")
     */
    private $geocode;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    private $filepath;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $addUser;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $lastModified;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Beer", mappedBy="brewery", cascade={"remove"})
     */
    private $beers;

    public function __construct()
    {
        $this->beers = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     *
     * @return Brewery
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $address1
     *
     * @return Brewery
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param string $address2
     *
     * @return Brewery
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string $city
     *
     * @return Brewery
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $state
     *
     * @return Brewery
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $code
     *
     * @return Brewery
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $country
     *
     * @return Brewery
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $phone
     *
     * @return Brewery
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $website
     *
     * @return Brewery
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $filepath
     *
     * @return Brewery
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;

        return $this;
    }

    /**
     * @return string
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * @param string $description
     *
     * @return Brewery
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param integer $addUser
     *
     * @return Brewery
     */
    public function setAddUser($addUser)
    {
        $this->addUser = $addUser;

        return $this;
    }

    /**
     * @return integer
     */
    public function getAddUser()
    {
        return $this->addUser;
    }

    /**
     * @param string $lastModified
     *
     * @return Brewery
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @return ArrayCollection
     */
    public function getBeers()
    {
        return $this->beers;
    }

    /**
     * @param Beer $beer
     */
    public function addBeer(Beer $beer)
    {
        $beer->setBrewery($this);
        $this->beers->add($beer);
    }

    /**
     * @param Beer $beer
     */
    public function removeBear(Beer $beer)
    {
        $this->beers->removeElement($beer);
    }

    /**
     * @return Geocode
     */
    public function getGeocode()
    {
        return $this->geocode;
    }

    /**
     * @param Geocode $geocode
     *
     * @return Brewery
     */
    public function setGeocode(Geocode $geocode)
    {
        $this->geocode = $geocode;

        return $this;
    }

    /**
     * @return int
     */
    public function getBeersCount()
    {
        return $this->beers->count();
    }
}

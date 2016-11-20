<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="beers")
 */
class Beer
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
     * @ORM\ManyToOne(targetEntity="Brewery", inversedBy="beers")
     */
    private $brewery;

    /**
     * @var string
     *
     * @ORM\Column(length=128)
     */
    private $name;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="beers")
     */
    private $category;

    /**
     * @var Style
     *
     * @ORM\ManyToOne(targetEntity="Style", inversedBy="beers")
     */
    private $style;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $abv;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $ibu;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $srm;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $upc;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Brewery $brewery
     *
     * @return Beer
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
     * Set name
     *
     * @param string $name
     *
     * @return Beer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Category $category
     *
     * @return Beer
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Style $style
     *
     * @return Beer
     */
    public function setStyle(Style $style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return Style
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set abv
     *
     * @param float $abv
     *
     * @return Beer
     */
    public function setAbv($abv)
    {
        $this->abv = $abv;

        return $this;
    }

    /**
     * Get abv
     *
     * @return float
     */
    public function getAbv()
    {
        return $this->abv;
    }

    /**
     * Set ibu
     *
     * @param float $ibu
     *
     * @return Beer
     */
    public function setIbu($ibu)
    {
        $this->ibu = $ibu;

        return $this;
    }

    /**
     * Get ibu
     *
     * @return float
     */
    public function getIbu()
    {
        return $this->ibu;
    }

    /**
     * Set srm
     *
     * @param float $srm
     *
     * @return Beer
     */
    public function setSrm($srm)
    {
        $this->srm = $srm;

        return $this;
    }

    /**
     * Get srm
     *
     * @return float
     */
    public function getSrm()
    {
        return $this->srm;
    }

    /**
     * Set upc
     *
     * @param integer $upc
     *
     * @return Beer
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;

        return $this;
    }

    /**
     * Get upc
     *
     * @return integer
     */
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * Set filepath
     *
     * @param string $filepath
     *
     * @return Beer
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;

        return $this;
    }

    /**
     * Get filepath
     *
     * @return string
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Beer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set addUser
     *
     * @param integer $addUser
     *
     * @return Beer
     */
    public function setAddUser($addUser)
    {
        $this->addUser = $addUser;

        return $this;
    }

    /**
     * Get addUser
     *
     * @return integer
     */
    public function getAddUser()
    {
        return $this->addUser;
    }

    /**
     * Set lastModified
     *
     * @param string $lastModified
     *
     * @return Beer
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return string
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getName();
    }
}

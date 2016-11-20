<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Category
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
     * @ORM\Column(type="string")
     */
    private $lastModified;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Beer", mappedBy="category", cascade={"remove"})
     */
    private $beers;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Style", mappedBy="category", cascade={"remove"})
     */
    private $styles;

    public function __construct()
    {
        $this->beers = new ArrayCollection();
        $this->styles = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
     * Set lastModified
     *
     * @param string $lastModified
     *
     * @return Category
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
        $beer->setCategory($this);
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
     * @return ArrayCollection
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * @param Style $style
     */
    public function addStyle(Style $style)
    {
        $style->setCategory($this);
        $this->styles->add($style);
    }

    /**
     * @param Style $style
     */
    public function removeStyle(Style $style)
    {
        $this->styles->removeElement($style);
    }
}

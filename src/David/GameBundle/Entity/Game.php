<?php

namespace David\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="David\GameBundle\Entity\GameRepository")
 */
class Game
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="date")
     */
    private $year;


    /**
     * @ORM\ManyToMany(targetEntity="David\GameBundle\Entity\Console")
     */
    private $consoles;
            
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
     * Set title
     *
     * @param string $title
     * @return Game
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Game
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
     * Set year
     *
     * @param \DateTime $year
     * @return Game
     */
    public function setYear($year)
    {
        $this->year = $year;
    
        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime 
     */
    public function getYear()
    {
        return $this->year;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->consoles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add consoles
     *
     * @param \David\GameBundle\Entity\Console $consoles
     * @return Game
     */
    public function addConsole(\David\GameBundle\Entity\Console $consoles)
    {
        $this->consoles[] = $consoles;
    
        return $this;
    }

    /**
     * Remove consoles
     *
     * @param \David\GameBundle\Entity\Console $consoles
     */
    public function removeConsole(\David\GameBundle\Entity\Console $consoles)
    {
        $this->consoles->removeElement($consoles);
    }

    /**
     * Get consoles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConsoles()
    {
        return $this->consoles;
    }
}
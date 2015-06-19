<?php

namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="activity")
 * @UniqueEntity(fields={"name"})
 */
class Activity 
{

 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

/**
     * @ORM\Column(name="name",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $name;



/**
     * @ORM\Column(name="description",type="string", length=1500)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $description;

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
     * @ORM\OneToMany(targetEntity="Gallery", mappedBy="activity")
     */
    protected $activities;


    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }
    public function __toString(){
  	return $this->name;
	}



    /**
     * Set name
     *
     * @param string $name
     * @return Activity
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
     * Set description
     *
     * @param string $description
     * @return Activity
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
     * Add activities
     *
     * @param \Acme\DemoBundle\Entity\Gallery $activities
     * @return Activity
     */
    public function addActivity(\Acme\DemoBundle\Entity\Gallery $activities)
    {
        $this->activities[] = $activities;

        return $this;
    }

    /**
     * Remove activities
     *
     * @param \Acme\DemoBundle\Entity\Gallery $activities
     */
    public function removeActivity(\Acme\DemoBundle\Entity\Gallery $activities)
    {
        $this->activities->removeElement($activities);
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivities()
    {
        return $this->activities;
    }
}

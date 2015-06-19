<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="suggest")
 * @ORM\HasLifecycleCallbacks
 */
class Suggest 
{
 /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


/**
     * @ORM\Column(name="fullname",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
  
    private $fullname;

/**
     * @ORM\Column(name="nationalid", type="integer")
      * @Assert\NotBlank()
    */
  
    private $nationalid;

/**
     * @ORM\Column(name="date",type="date")
     * @Assert\NotBlank()
     */
  
    private $date;
public function __construct(){
    $this->date=new \DateTime("yesterday");
}

/**
     * @ORM\Column(name="suggest",type="string", length=1200)
     * @Assert\NotBlank()
     */
  
    private $suggest;

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
     * Set fullname
     *
     * @param string $fullname
     * @return Suggest
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set nationalid
     *
     * @param integer $nationalid
     * @return Suggest
     */
    public function setNationalid($nationalid)
    {
        $this->nationalid = $nationalid;

        return $this;
    }

    /**
     * Get nationalid
     *
     * @return integer 
     */
    public function getNationalid()
    {
        return $this->nationalid;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Suggest
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set suggest
     *
     * @param string $suggest
     * @return Suggest
     */
    public function setSuggest($suggest)
    {
        $this->suggest = $suggest;

        return $this;
    }

    /**
     * Get suggest
     *
     * @return string 
     */
    public function getSuggest()
    {
        return $this->suggest;
    }
}

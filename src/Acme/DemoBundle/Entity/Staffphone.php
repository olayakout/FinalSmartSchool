<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Acme\DemoBundle\Entity\Staff;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity
 * @ORM\Table(name="staffphone")
 * @UniqueEntity(fields={"user", "phone"})
 */
class Staffphone 
{

 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

  /** 
     * @ORM\Column(type="string", length=100)
     */
    private $phone;

  /**
     * @ORM\ManyToOne(targetEntity="Staff", inversedBy="phones")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id" , onDelete="CASCADE")
     */
    protected $user;

    
    /**
     * Set phone
     *
     * @param string $phone
     * @return Staffphone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set user
     *
     * @param \Acme\DemoBundle\Entity\Staff $user
     * @return Staffphone
     */
    public function setUser(\Acme\DemoBundle\Entity\Staff $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Acme\DemoBundle\Entity\Staff 
     */
    public function getUser()
    {
        return $this->user;
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
}

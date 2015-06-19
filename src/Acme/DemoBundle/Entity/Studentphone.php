<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Acme\DemoBundle\Entity\Staff;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity
 * @ORM\Table(name="studentphone")
 * @UniqueEntity(fields={"user", "phone"})
 */
class Studentphone 
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
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="phones")
     * @ORM\JoinColumn(name="owner", referencedColumnName="id" , onDelete="CASCADE")
     */
    protected $user;

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
     * Set phone
     *
     * @param string $phone
     * @return Studentphone
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
     * @param \Acme\DemoBundle\Entity\Student $user
     * @return Studentphone
     */
    public function setUser(\Acme\DemoBundle\Entity\Student $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Acme\DemoBundle\Entity\Student 
     */
    public function getUser()
    {
        return $this->user;
    }
}

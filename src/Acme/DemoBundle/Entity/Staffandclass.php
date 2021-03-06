<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="staffandclass")
 */
class Staffandclass
{

 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Staff", inversedBy="classes")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="id", onDelete="CASCADE")
     **/
    private $staff;

    /**
     * @ORM\ManyToOne(targetEntity="Studentclass", inversedBy="teachers")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id",nullable=true , onDelete="CASCADE")
     **/
    private $class;

    /**
     * Set staff
     *
     * @param \Acme\DemoBundle\Entity\Staff $staff
     * @return Staffandclass
     */
    public function setStaff(\Acme\DemoBundle\Entity\Staff $staff)
    {
        $this->staff = $staff;

        return $this;
    }

    /**
     * Get staff
     *
     * @return \Acme\DemoBundle\Entity\Staff 
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * Set class
     *
     * @param \Acme\DemoBundle\Entity\Studentclass $class
     * @return Staffandclass
     */
    public function setClass(\Acme\DemoBundle\Entity\Studentclass $class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \Acme\DemoBundle\Entity\Studentclass 
     */
    public function getClass()
    {
        return $this->class;
    }
}

<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="studentandclass")
 */
class Studentandclass
{
 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="classes")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id", onDelete="CASCADE")
     **/
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity="Studentclass", inversedBy="students")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id" , onDelete="CASCADE" , nullable=true)
     **/
    private $class;


    /**
     * Set student
     *
     * @param \Acme\DemoBundle\Entity\Student $student
     * @return Studentandclass
     */
    public function setStudent(\Acme\DemoBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \Acme\DemoBundle\Entity\Student 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set class
     *
     * @param \Acme\DemoBundle\Entity\Studentclass $class
     * @return Studentandclass
     */
    public function setClass(\Acme\DemoBundle\Entity\Studentclass $class = null)
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


    public function __toString(){
  	return $this->class->getName();
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

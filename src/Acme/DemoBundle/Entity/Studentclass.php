<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="class")
 */
class Studentclass
{

 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

 /**
     * @ORM\OneToMany(targetEntity="Studentandclass", mappedBy="class")
     **/
    private $students;

 /**
     * @ORM\OneToMany(targetEntity="Staffandclass", mappedBy="class")
     **/
    private $teachers;

/**
     * @ORM\Column(name="name",type="string", length=200 , unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $name;

   /**
     * @ORM\OneToMany(targetEntity="Gallery", mappedBy="studentclass")
     */
    protected $photos;


    public function __construct()
    {
        $this->photos = new ArrayCollection();
	$this->students = new ArrayCollection();
    }
    public function __toString(){
  	return $this->name;
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
     * @return Studentclass
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
     * Add photos
     *
     * @param \Acme\DemoBundle\Entity\Gallery $photos
     * @return Studentclass
     */
    public function addPhoto(\Acme\DemoBundle\Entity\Gallery $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \Acme\DemoBundle\Entity\Gallery $photos
     */
    public function removePhoto(\Acme\DemoBundle\Entity\Gallery $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add students
     *
     * @param \Acme\DemoBundle\Entity\Studentandclass $students
     * @return Studentclass
     */
    public function addStudent(\Acme\DemoBundle\Entity\Studentandclass $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \Acme\DemoBundle\Entity\Studentandclass $students
     */
    public function removeStudent(\Acme\DemoBundle\Entity\Studentandclass $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Add teachers
     *
     * @param \Acme\DemoBundle\Entity\Staffandclass $teachers
     * @return Studentclass
     */
    public function addTeacher(\Acme\DemoBundle\Entity\Staffandclass $teachers)
    {
        $this->teachers[] = $teachers;

        return $this;
    }

    /**
     * Remove teachers
     *
     * @param \Acme\DemoBundle\Entity\Staffandclass $teachers
     */
    public function removeTeacher(\Acme\DemoBundle\Entity\Staffandclass $teachers)
    {
        $this->teachers->removeElement($teachers);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeachers()
    {
        return $this->teachers;
    }
}

<?php 

namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Acme\DemoBundle\Entity\Student;
use Acme\DemoBundle\Entity\Staff;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
* @ORM\Entity
* @ORM\Table(name="Staffstudent")
*@UniqueEntity(fields={"note", "student" ,"member"})
* @ORM\HasLifecycleCallbacks
*/

class StaffStudent{


//AND SOME COLUMNS HERE

/**
* @ORM\Id
* @Assert\NotBlank
* @ORM\Column(type="string", length=255)
*/
protected $note;

/**
* @Assert\NotBlank
* @ORM\Column(type="string", length=200)
*/
protected $noteType;


/**
* @ORM\Id
* @ORM\ManyToOne(targetEntity="Student", inversedBy="staff")
* @ORM\JoinTable(name="Staffstudent")
* @ORM\JoinColumn(name="student_id", referencedColumnName="id",onDelete="cascade")
*/
private $student;

/**
* @ORM\Id
* @ORM\ManyToOne(targetEntity="Staff", inversedBy="student")
* @ORM\JoinTable(name="Staffstudent")
* @ORM\JoinColumn(name="member_id", referencedColumnName="id",onDelete="cascade")
*/
private $member;


/**
* @ORM\Column(type="date",nullable=true)    
*/
protected $noteDate;
//........
public function __construct()
{
$this->students= new ArrayCollection();
$this->staff= new ArrayCollection();

}




public function __toString(){
return $this->student;
}

/**
* Set note
*
* @param string $note
* @return StaffStudent
*/
public function setNote($note)
{
$this->note = $note;

return $this;
}

/**
* Get note
*
* @return string 
*/
public function getNote()
{
return $this->note;
}

/**
* Set noteType
*
* @param string $noteType
* @return StaffStudent
*/
public function setNoteType($noteType)
{
$this->noteType = $noteType;

return $this;
}

/**
* Get noteType
*
* @return string 
*/
public function getNoteType()
{
return $this->noteType;
}

/**
* Set noteDate
*
* @param \DateTime $noteDate
* @return StaffStudent
*/
public function setNoteDate($noteDate)
{
$this->noteDate = $noteDate;

return $this;
}

/**
* Get noteDate
*
* @return \DateTime 
*/
public function getNoteDate()
{
return $this->noteDate;
}

/**
* Set student
*
* @param \Acme\DemoBundle\Entity\Student $student
* @return StaffStudent
*/
public function setStudent(\Acme\DemoBundle\Entity\Student $student)
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
* Set member
*
* @param \Acme\DemoBundle\Entity\Staff $member
* @return StaffStudent
*/
public function setMember(\Acme\DemoBundle\Entity\Staff $member)
{
$this->member = $member;

return $this;
}

/**
* Get member
*
* @return \Acme\DemoBundle\Entity\Staff 
*/
public function getMember()
{
return $this->member;
}
}

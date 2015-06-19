<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="staff")
 * @UniqueEntity(
 *     fields={"nationalid"},
 *     errorPath="nationalid",
 *     message="يجب ادخال قيمة اخرى هذه القيمة موجودة بالفعل "
 *)
 * @ORM\HasLifecycleCallbacks
 */
class Staff 
{
 /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="Staffphone", mappedBy="user")
     */
    protected $phones;



       /**
    * @ORM\OneToMany(targetEntity="StaffStudent", mappedBy="member")
    */
private $student;
 /**
  * @ORM\OneToMany(targetEntity="StaffNote", mappedBy="notes")
  */
protected $users;

    /**
     * @ORM\OneToMany(targetEntity="Staffandclass", mappedBy="staff")
     **/
    private $classes;


    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->student = new ArrayCollection();
	$this->users = new ArrayCollection();
    	$this->classes = new ArrayCollection();
    }

    public function __toString(){
		return $this->fullname;
	}

////////////////////////////////////////
//upload photo
//////////////////
  /**
     * @var string $image
     * @Assert\File( maxSize = "1024k", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

public function getFullImagePath() {
        return null === $this->image ? null : $this->getUploadRootDir(). $this->image;
    }
 
    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir().$this->getId()."/";
    }
 
    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/upload/staff/';
    }
 
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadImage() {
        // the file property can be empty if the field is not required
        if (null === $this->image) {
            return;
        }
        if(!$this->id){
            $this->image->move($this->getTmpUploadRootDir(), $this->image->getClientOriginalName());
        }else{
            $this->image->move($this->getUploadRootDir(), $this->image->getClientOriginalName());
        }
        $this->setImage($this->image->getClientOriginalName());
    }
 
    /**
     * @ORM\PostPersist()
     */
    public function moveImage()
    {
        if (null === $this->image) {
            return;
        }
        if(!is_dir($this->getUploadRootDir())){
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir().$this->image, $this->getFullImagePath());
        unlink($this->getTmpUploadRootDir().$this->image);
    }
 
    /**
     * @ORM\PreRemove()
     */
    public function removeImage()
    {
	if(null !== $this->getFullImagePath() && $this->image != null )
	{
        unlink($this->getFullImagePath());
	}
	if(null !== $this->getUploadRootDir() && $this->image != null){
        rmdir($this->getUploadRootDir());
}
    }


/**
     * @ORM\Column(name="fullname",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
  
    private $fullname;

/**
     * @ORM\Column(name="anotherstudy",type="string", length=200,nullable=true)
     */
  
    private $anotherstudy;

/**
     * @ORM\Column(name="code", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=6)
     */
  
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="users")
     * @ORM\JoinColumn(name="job_id", referencedColumnName="id",onDelete="cascade")
     */
    protected $job;

/**
     * @ORM\Column(name="graduate",type="string", length=200)
     * @Assert\NotBlank()
     */
  
    private $graduate;

/**
     * @ORM\Column(name="dateofgraduate",type="date")
     * @Assert\NotBlank()
     */
  
    private $dateofgraduate;
/**
     * @ORM\Column(name="dateofanotherstudy",type="date",nullable=true)
     */
  
    private $dateofanotherstudy;

/**
     * @ORM\Column(name="birthday",type="date")
     * @Assert\NotBlank()
     */
  
    private $birthday;

/**
     * @ORM\Column(name="appointmentdate",type="date")
     * @Assert\NotBlank()
     */
  
    private $appointmentdate;

/**
     * @ORM\Column(name="joindate",type="date")
     * @Assert\NotBlank()
     */
  
    private $joindate;

/**
     * @ORM\Column(name="degree",type="string", length=200)
     * @Assert\NotBlank()
     */
  
    private $degree;

/**
     * @ORM\Column(name="dateofgetdegree",type="date")
     * @Assert\NotBlank()
     */
  
    private $dateofgetdegree;

/**
     * @ORM\Column(name="nationalid", type="string", length=200, unique=true)
      * @Assert\NotBlank()
    */
  
    private $nationalid;

/**
     * @ORM\Column(name="address",type="string", length=200)
     * @Assert\NotBlank()
     */
  
    private $address;
  

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
     * Set image
     *
     * @param string $image
     * @return Staff
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     * @return Staff
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
     * Set anotherstudy
     *
     * @param string $anotherstudy
     * @return Staff
     */
    public function setAnotherstudy($anotherstudy)
    {
        $this->anotherstudy = $anotherstudy;

        return $this;
    }

    /**
     * Get anotherstudy
     *
     * @return string 
     */
    public function getAnotherstudy()
    {
        return $this->anotherstudy;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return Staff
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set graduate
     *
     * @param string $graduate
     * @return Staff
     */
    public function setGraduate($graduate)
    {
        $this->graduate = $graduate;

        return $this;
    }

    /**
     * Get graduate
     *
     * @return string 
     */
    public function getGraduate()
    {
        return $this->graduate;
    }

    /**
     * Set dateofgraduate
     *
     * @param \DateTime $dateofgraduate
     * @return Staff
     */
    public function setDateofgraduate($dateofgraduate)
    {
        $this->dateofgraduate = $dateofgraduate;

        return $this;
    }

    /**
     * Get dateofgraduate
     *
     * @return \DateTime 
     */
    public function getDateofgraduate()
    {
        return $this->dateofgraduate;
    }

    /**
     * Set dateofanotherstudy
     *
     * @param \DateTime $dateofanotherstudy
     * @return Staff
     */
    public function setDateofanotherstudy($dateofanotherstudy)
    {
        $this->dateofanotherstudy = $dateofanotherstudy;

        return $this;
    }

    /**
     * Get dateofanotherstudy
     *
     * @return \DateTime 
     */
    public function getDateofanotherstudy()
    {
        return $this->dateofanotherstudy;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Staff
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set appointmentdate
     *
     * @param \DateTime $appointmentdate
     * @return Staff
     */
    public function setAppointmentdate($appointmentdate)
    {
        $this->appointmentdate = $appointmentdate;

        return $this;
    }

    /**
     * Get appointmentdate
     *
     * @return \DateTime 
     */
    public function getAppointmentdate()
    {
        return $this->appointmentdate;
    }

    /**
     * Set joindate
     *
     * @param \DateTime $joindate
     * @return Staff
     */
    public function setJoindate($joindate)
    {
        $this->joindate = $joindate;

        return $this;
    }

    /**
     * Get joindate
     *
     * @return \DateTime 
     */
    public function getJoindate()
    {
        return $this->joindate;
    }

    /**
     * Set degree
     *
     * @param string $degree
     * @return Staff
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get degree
     *
     * @return string 
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set dateofgetdegree
     *
     * @param \DateTime $dateofgetdegree
     * @return Staff
     */
    public function setDateofgetdegree($dateofgetdegree)
    {
        $this->dateofgetdegree = $dateofgetdegree;

        return $this;
    }

    /**
     * Get dateofgetdegree
     *
     * @return \DateTime 
     */
    public function getDateofgetdegree()
    {
        return $this->dateofgetdegree;
    }

    /**
     * Set nationalid
     *
     * @param integer $nationalid
     * @return Staff
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
     * Set address
     *
     * @param string $address
     * @return Staff
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add phones
     *
     * @param \Acme\DemoBundle\Entity\Staffphone $phones
     * @return Staff
     */
    public function addPhone(\Acme\DemoBundle\Entity\Staffphone $phones)
    {
        $this->phones[] = $phones;

        return $this;
    }

    /**
     * Remove phones
     *
     * @param \Acme\DemoBundle\Entity\Staffphone $phones
     */
    public function removePhone(\Acme\DemoBundle\Entity\Staffphone $phones)
    {
        $this->phones->removeElement($phones);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Set job
     *
     * @param \Acme\DemoBundle\Entity\Job $job
     * @return Staff
     */
    public function setJob(\Acme\DemoBundle\Entity\Job $job = null)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return \Acme\DemoBundle\Entity\Job 
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Add student
     *
     * @param \Acme\DemoBundle\Entity\StaffStudent $student
     * @return Staff
     */
    public function addStudent(\Acme\DemoBundle\Entity\StaffStudent $student)
    {
        $this->student[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \Acme\DemoBundle\Entity\StaffStudent $student
     */
    public function removeStudent(\Acme\DemoBundle\Entity\StaffStudent $student)
    {
        $this->student->removeElement($student);
    }

    /**
     * Get student
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Add users
     *
     * @param \Acme\DemoBundle\Entity\StaffNote $users
     * @return Staff
     */
    public function addUser(\Acme\DemoBundle\Entity\StaffNote $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Acme\DemoBundle\Entity\StaffNote $users
     */
    public function removeUser(\Acme\DemoBundle\Entity\StaffNote $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add classes
     *
     * @param \Acme\DemoBundle\Entity\Staffandclass $classes
     * @return Staff
     */
    public function addClass(\Acme\DemoBundle\Entity\Staffandclass $classes)
    {
        $this->classes[] = $classes;

        return $this;
    }

    /**
     * Remove classes
     *
     * @param \Acme\DemoBundle\Entity\Staffandclass $classes
     */
    public function removeClass(\Acme\DemoBundle\Entity\Staffandclass $classes)
    {
        $this->classes->removeElement($classes);
    }

    /**
     * Get classes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClasses()
    {
        return $this->classes;
    }
}

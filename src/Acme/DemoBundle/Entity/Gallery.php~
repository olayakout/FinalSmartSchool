<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="gallery")
 * @ORM\HasLifecycleCallbacks
 */
class Gallery 
{

 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Studentclass", inversedBy="photos")
     * @ORM\JoinColumn(name="class_id", referencedColumnName="id",onDelete="cascade")
     */
    protected $class;
   
    /**
     * @ORM\ManyToOne(targetEntity="Activity", inversedBy="activities")
     * @ORM\JoinColumn(name="activity_id", referencedColumnName="id",onDelete="cascade")
     */
    protected $activity;

////////////////////////////////////////
//upload photo
//////////////////
  /**
     * @var string $image
     * @Assert\File( maxSize = "500M", mimeTypesMessage = "Please upload a valid Image")
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
        return __DIR__ . '/../../../../web/upload/gallery/';
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
     * @ORM\Column(name="dateofpic",type="date")
     * @Assert\NotBlank()
     */
  
    private $dateofpic;




   
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
     * @return Gallery
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
     * Set dateofpic
     *
     * @param \DateTime $dateofpic
     * @return Gallery
     */
    public function setDateofpic($dateofpic)
    {
        $this->dateofpic = $dateofpic;

        return $this;
    }

    /**
     * Get dateofpic
     *
     * @return \DateTime 
     */
    public function getDateofpic()
    {
        return $this->dateofpic;
    }

    /**
     * Set class
     *
     * @param \Acme\DemoBundle\Entity\Studentclass $class
     * @return Gallery
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

    /**
     * Set activity
     *
     * @param \Acme\DemoBundle\Entity\Activity $activity
     * @return Gallery
     */
    public function setActivity(\Acme\DemoBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \Acme\DemoBundle\Entity\Activity 
     */
    public function getActivity()
    {
        return $this->activity;
    }
}

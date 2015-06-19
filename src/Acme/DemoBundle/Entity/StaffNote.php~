<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Acme\DemoBundle\Entity\Staff;


/**
* @ORM\Entity
* @ORM\Table(name="staffnotes")
* @ORM\HasLifecycleCallbacks
*/
class StaffNote 
{

/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
protected $id;

/**
* @ORM\Column(type="string")
* @Assert\NotBlank()
*/
protected $mynote;

/**
* @ORM\Column(type="string")
* @Assert\NotBlank()
*/
protected $noteType;


/**
* @ORM\Column(type="date")
* @Assert\NotBlank()
*/
protected $noteDate;

	/**
     * @ORM\ManyToOne(targetEntity="Staff", inversedBy="users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",onDelete="cascade")
     */
    protected $notes;







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
     * Set mynote
     *
     * @param string $mynote
     * @return StaffNote
     */
    public function setMynote($mynote)
    {
        $this->mynote = $mynote;

        return $this;
    }

    /**
     * Get mynote
     *
     * @return string 
     */
    public function getMynote()
    {
        return $this->mynote;
    }

    /**
     * Set noteType
     *
     * @param string $noteType
     * @return StaffNote
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
     * @return StaffNote
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
     * Set notes
     *
     * @param \Acme\DemoBundle\Entity\Staff $notes
     * @return StaffNote
     */
    public function setNotes(\Acme\DemoBundle\Entity\Staff $notes = null)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return \Acme\DemoBundle\Entity\Staff 
     */
    public function getNotes()
    {
        return $this->notes;
    }
}

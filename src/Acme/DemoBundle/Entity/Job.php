<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="job")
 */
class Job 
{

 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

/**
     * @ORM\Column(name="job",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $job;

    /**
     * @ORM\OneToMany(targetEntity="Staff", mappedBy="staffjob")
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * Set job
     *
     * @param string $job
     * @return Job
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }
 
    public function __toString(){
  return $this->job;
}


    /**
     * Get job
     *
     * @return string 
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Add users
     *
     * @param \Acme\DemoBundle\Entity\Staff $users
     * @return Job
     */
    public function addUser(\Acme\DemoBundle\Entity\Staff $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Acme\DemoBundle\Entity\Staff $users
     */
    public function removeUser(\Acme\DemoBundle\Entity\Staff $users)
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
}

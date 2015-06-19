<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="link")
 * @UniqueEntity(fields={"title", "url" ,"about"})
 */
class Link 
{

 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

/**
     * @ORM\Column(name="title",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $title;

/**
     * @ORM\Column(name="url",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $url;

/**
     * @ORM\Column(name="about",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $about;    

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
     * Set url
     *
     * @param string $url
     * @return Link
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set about
     *
     * @param string $about
     * @return Link
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Link
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}

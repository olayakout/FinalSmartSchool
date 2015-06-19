<?php


namespace Acme\DemoBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 * @UniqueEntity(fields={"name", "author" ,"code" ,"publishinghouse"})
 */
class Book 
{

 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

/**
     * @ORM\Column(name="name",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $name;

/**
     * @ORM\Column(name="author",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $author;

/**
     * @ORM\Column(name="code",type="string", length=200)
     * @Assert\NotBlank()
     */
  
    private $code;

/**
     * @ORM\Column(name="publishinghouse",type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
  
    private $publishinghouse;

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
     * @return Book
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
     * Set author
     *
     * @param string $author
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Book
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set publishinghouse
     *
     * @param string $publishinghouse
     * @return Book
     */
    public function setPublishinghouse($publishinghouse)
    {
        $this->publishinghouse = $publishinghouse;

        return $this;
    }

    /**
     * Get publishinghouse
     *
     * @return string 
     */
    public function getPublishinghouse()
    {
        return $this->publishinghouse;
    }
}

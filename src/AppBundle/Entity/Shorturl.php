<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Shorturl
 *
 * @ORM\Table(name="shorturl")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShorturlRepository")
 */
class Shorturl
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Assert\NotBlank()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="longUrl", length="255")
     * @ORM\longUrl
     * @Assert\NotBlank()
     */
    private $longUrl;


    /**
     * @var string
     *
     * @ORM\Column(name="shortCode", length="6")
     * @ORM\shortCode
     * @Assert\NotBlank()
     */
    private $shortCode;


    /**
     * @var int
     *
     * @ORM\Column(name="createdAt", type="integer")
     * @ORM\createdAt
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    private $createdAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get longUrl
     *
     * @return string
     */
    public function getLongUrl()
    {
        return $this->longUrl;
    }

     /**
     * Get longUrl
     *
     * @return string
     */
    public function getShortCode()
    {
        return $this->shortCode;
    }

     /**
     * Get longUrl
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

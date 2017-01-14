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
class ShorturlEntity
{
    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="url", type="string", length=500, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    private $url;


    /**
     *
     * @ORM\Column(name="code", type="string", length=6, nullable=false)
     */
    private $code;


    /**
     *
     * @ORM\Column(name="created_at", type="integer", nullable=false)
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
     * [setId description]
     * @param [type] $id [description]
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Get Url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * [setUrl description]
     * @param [type] $url [description]
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * [setCode description]
     * @param [type] $code [description]
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

     /**
     * Get screatedAt
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * [setCreatedAt description]
     * @param [type] $ceratedAt [description]
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}

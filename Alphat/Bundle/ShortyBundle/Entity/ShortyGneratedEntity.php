<?php

namespace Alphat\Bundle\ShortyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Shorty
 *
 * @ORM\Table(name="shorty",uniqueConstraints={@ORM\UniqueConstraint(name="code_idx", columns={"code"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShortyRepository")
 */
class ShortyEntity
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
     * @ORM\Column(name="code", type="string", length=6, nullable=false, unique=true)
     */
    private $code;

    /**
     * @ORM\Column(name="counter", type="integer", nullable=false, options={"unsigned":true, "default":0})
     */
    private $counter;


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
     * @param integer $id
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
     * @param string $url
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
     * @param string $code
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
    public function getCounter()
    {
        return $this->counter;
    }


     /**
     * Get createdAt
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param integer $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}


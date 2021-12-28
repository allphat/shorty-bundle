<?php

namespace  Allphat\Bundle\ShortyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Shorty
 *
 * @ORM\Table(name="shorty",uniqueConstraints={@ORM\UniqueConstraint(name="code_generated_idx", columns={"code"})})
 * @ORM\Entity(repositoryClass="Allpĥat\Bundle\ShortyBundle\Repository\ShortyRepository")
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
     * @ORM\Column(name="code", type="string", nullable = false, options={"aaaaaa"})
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    private $code;


    /**
     * @ORM\Column(name="is_used", type="boolean", options={"default":false})
     */
    private $is_used;


    /**
     *
     * @ORM\Column(name="created_at", type="integer", nullable=false)
     */
    private $createdAt;


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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param boolean $isUsed
     */
    public function setIsUsed($isUsed)
    {
        $this->is_used = $isUsed;

        return $this;
    }

    /**
     * Get is_used
     *
     * @return boolean
     */
    public function getIsUsed()
    {
        return $this->is_used;
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

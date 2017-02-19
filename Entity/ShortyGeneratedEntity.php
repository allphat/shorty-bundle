<?php

namespace  Alphat\Bundle\ShortyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Shorty
 *
 * @ORM\Table(name="shorty_generated",uniqueConstraints={@ORM\UniqueConstraint(name="code_generated_idx", columns={"code"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShortyGeneratedRepository")
 */
class ShortyGeneratedEntity
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
}

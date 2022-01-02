<?php

namespace Allphat\ShortyBundle\Entity;

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
     *
     * @var int
     */
    private $id;

    /**
     *
     * @ORM\Column(name="code", type="string", nullable = false, options={"aaaaaa"})
     * @Assert\NotBlank()
     * @Assert\Url()
     *
     * @var string
     */
    private $code;


    /**
     * @ORM\Column(name="is_used", type="boolean", options={"default":false})
     *
     * @var bool
     */
    private $is_used;


    /**
     *
     * @ORM\Column(name="created_at", type="integer", nullable=false)
     *
     * @var int
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

    public function setCode(string $code): self
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

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setIsUsed(bool $isUsed): self
    {
        $this->is_used = $isUsed;

        return $this;
    }

    public function getIsUsed(): bool
    {
        return $this->is_used;
    }

    public function getCreatedAt(): int 
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
<?php

namespace Allphat\ShortyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
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
     * @ORM\Column(name="short_url", type="string", nullable = true)
     * @Assert\Url()
     *
     * @var string
     */
    private $shortUrl;
    
    /**
     *
     * @ORM\Column(name="code", type="string", nullable = false, unique=true)
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $code;
    
    /**
     *
     * @ORM\Column(name="source_url", type="string", nullable = false, unique=true)
     * @Assert\NotBlank()
     * @Assert\Url()
     *
     * @var string
     */
    private $sourceUrl;


    /**
     * @ORM\Column(name="is_used", type="boolean", options={"default":false})
     *
     * @var bool
     */
    private $isUsed;


    /**
     *
     * @ORM\Column(name="created_at", type="integer", nullable=false)
     *
     * @var int
     */
    private $createdAt;
    
    /**
     * @ORM\Column(name="starts_at", type="integer", nullable=true)
     *
     * @var int
     */
    private $startsAt;
    
    /**
     * @ORM\Column(name="ends_at", type="integer", nullable=true)
     *
     * @var int|null
     */
    private $endsAt;

    /**
     * @ORM\Column(name="counter", type="integer", nullable=false, options={"default":0})
     *
     * @var int
     */
    private $counter;
    
    /**
     * @ORM\Column(name="max_calls", type="integer", nullable=true)
     *
     * @var int
     */
    private $maxCalls;
    
    public function getCode(): string   
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setShortUrl(string $url): self
    {
        $this->shortUrl = $url;

        return $this;
    }
    
    public function getSourceUrl(): string   
    {
        return $this->sourceUrl;
    }

    public function setSourceUrl(string $url): self
    {
        $this->sourceUrl = $url;

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
        $this->isUsed = $isUsed;

        return $this;
    }

    public function getIsUsed(): bool
    {
        return $this->isUsed;
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
    
    public function setStartsAt(int $startsAt): self
    {
        $this->startsAt = $startsAt;
        
        return $this;
    }
    
    public function getStartsAt()
    {
        return $this->startsAt;
    }
    
    public function setEndsAt(int $endsAt=null): self
    {
        $this->endsAt = $endsAt;       
    }
  
    public function getEndsAt(): ?int
    {
        return $this->endsAt;
    }
    
    public function incrementCounter(): self
    {
        $this->counter++;
        
        return $this; 
    }
  
    public function getCounter(): int
    {
        return $this->counter;
    }
    
    public function setMaxCalls(int $max=null): self
    {
        $this->maxCalls = $max;
        
        return $this;
    }   
  
    public function getMaxCalls(): ?int
    {
        return $this->maxCalls;
    }
}
<?php

namespace Tests\Allphat\ShortyBundle\Entity;

use Allphat\ShortyBundle\Entity\ShortyEntity;


class ShortyEntityTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ShortyEntity
     */ 
    private $entity;

    public function setUp(): void
    {
        $this->entity = new ShortyEntity();

        $this->entity->setId(1);
        $this->entity->setCode('xxxxxx');
        $this->entity->setIsUsed(true);
        $this->entity->setCreatedAt((new \DateTime())->getTimestamp());
    }

    public function testGetId(): void
    {
        $this->assertEquals(1, $this->entity->getId());
    }

    public function testGetCode(): void
    {
        $this->assertEquals('xxxxxx', $this->entity->getCode());
    }

    public function testIsUsed(): void
    {
        $this->assertTrue($this->entity->getIsUsed());
    }

    public function testSetCreatedAt(): void
    {
        $this->assertGreaterThanOrEqual((new \DateTime())->getTimestamp(), $this->entity->getCreatedAt());
    }
}
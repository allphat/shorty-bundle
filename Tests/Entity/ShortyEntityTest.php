<?php

namespace Tests\Alphat\Bundle\ShortyBundle\Entity;

use Alphat\Bundle\ShortyBundle\Entity\ShortyEntity;


class ShortyEntityTest extends \PHPUnit_Framework_TestCase
{
    private $entity;

    public function setUp()
    {
        $this->entity = new ShortyEntity();

        $this->entity->setId(1);
        $this->entity->setCode('xxxxxx');
        $this->entity->setIsUsed(true);
        $this->entity->setCreatedAt((new \DateTime())->getTimestamp());
    }

    public function testGetId()
    {
        $this->assertEquals(1, $this->entity->getId());
    }

    public function testGetCode()
    {
        $this->assertEquals('xxxxxx', $this->entity->getCode());
    }

    public function testIsUsed()
    {
        $this->assertTrue($this->entity->getIsUsed());
    }

    public function testSetCreatedAt()
    {
        $this->assertGreaterThanOrEqual((new \DateTime())->getTimestamp(), $this->entity->getCreatedAt());
    }
}


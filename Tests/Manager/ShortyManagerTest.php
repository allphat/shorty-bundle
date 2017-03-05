<?php

namespace Tests\Alphat\Bundle\ShortyBundle\Manager;

use Alphat\Bundle\ShortyBundle\Entity\ShortyEntity;
use Alphat\Bundle\ShortyBundle\Manager\ShortyManager;
use Alphat\Bundle\ShortyBundle\Repository\ShortyRepository;


class ShortyManagerTest extends \PHPUnit_Framework_TestCase
{
    private $repository;
    private $manager;

    public function setUp()
    {
        $this->repository = $this->getMockBuilder(ShortyRepository::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['findByCode', 'save', 'findUnusedOne', 'persist'])
                     ->getMock();

        $this->manager = new ShortyManager($this->repository);
    }

    public function testFindByCode()
    {
        $this->repository->expects($this->once())
            ->method('findByCode')
            ->with('test');

        $this->manager->findByCode('test');
    }

    public function testEncode()
    {
        $this->assertRegExp('/\w{6}/', $this->manager->encode());
    }

    public function testCreateEntity()
    {
        $result = $this->manager->createEntity();

        $this->assertFalse($result->getIsUsed());
    }

    public function testCreateAndUseEntity()
    {
        $result = $this->manager->createAndUseEntity();

        $this->assertTrue($result->getIsUsed());
    }

    public function testSaveNoDb()
    {
        $result = $this->manager->save(false);

        $this->assertTrue($result->getIsUsed());
        $this->assertRegExp('/\w{6}/', $result->getCode());
    }

    public function testSaveKnown()
    {
        $shortyEntity = new ShortyEntity();
        $shortyEntity->setCode('vrl38H');
        $shortyEntity->setIsUsed(false);

        $this->repository->expects($this->once())
            ->method('findUnusedOne')
            ->willReturn($shortyEntity);

        $this->repository->expects($this->once())
            ->method('persist')
            ->with($shortyEntity);

        $this->repository->expects($this->once())
            ->method('save');

        $result = $this->manager->save(true);

        $this->assertTrue($result->getIsUsed());
        $this->assertEquals('vrl38H', $result->getCode());
    }

    public function testSaveNew()
    {
        $this->repository->expects($this->once())
            ->method('findUnusedOne')
            ->willReturn(null);

        $this->repository->expects($this->once())
            ->method('persist');

        $this->repository->expects($this->once())
            ->method('save');

        $result = $this->manager->save(true);

        $this->assertTrue($result->getIsUsed());
        $this->assertRegExp('/\w{6}/', $result->getCode());

    }
}
<?php

namespace Tests\Alphat\Bundle\ShortyBundle\Manager;

use Alphat\Bundle\ShortyBundle\Entity\ShortyEntity;
use Alphat\Bundle\ShortyBundle\Entity\ShortyGeneratedEntity;
use Alphat\Bundle\ShortyBundle\Manager\ShortyManager;
use Alphat\Bundle\ShortyBundle\Repository\ShortyRepository;
use Alphat\Bundle\ShortyBundle\Repository\ShortyGeneratedRepository;


class ShortyManagerTest extends \PHPUnit_Framework_TestCase
{
    private $repository;
    private $manager;

    public function setUp()
    {
        $this->repository = $this->getMockBuilder(ShortyRepository::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['findByCode', 'save'])
                     ->getMock();

        $this->generatedRepository = $this->getMockBuilder(ShortyGeneratedRepository::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['findUnusedOne', 'save'])
                     ->getMock();

        $this->manager = new ShortyManager($this->repository, $this->generatedRepository);
    }

    public function testFindByCode()
    {
        $this->repository->expects($this->once())
            ->method('findByCode')
            ->with('test');

        $this->manager->findByCode('test');
    }

    public function testSave()
    {
        $short = new ShortyEntity();
        $shortyGenerated = new ShortyGeneratedEntity();
        $shortyGenerated->setCode('vrl38H');

        $this->generatedRepository->expects($this->once())
            ->method('findUnusedOne')
            ->willReturn($shortyGenerated);

        $this->repository->expects($this->once())
            ->method('save')
            ->with($short);

        $this->generatedRepository->expects($this->once())
            ->method('save')
            ->with($shortyGenerated);

        $this->manager->save($short);

        $this->assertRegExp('/[\w]{6}/', $short->getCode());
    }
}
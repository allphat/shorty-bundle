<?php

namespace Tests\AppBundle\Manager;

use AppBundle\Entity\ShortyEntity;
use AppBundle\Entity\ShortyGeneratedEntity;
use AppBundle\Manager\ShortyManager;
use AppBundle\Repository\ShortyRepository;
use AppBundle\Repository\ShortyGeneratedRepository;


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
<?php

namespace Tests\AppBundle\Manager;

use AppBundle\Entity\ShorturlEntity;
use AppBundle\Manager\ShorturlManager;
use AppBundle\Repository\ShorturlRepository;

class ShorturlManagerTest extends \PHPUnit_Framework_TestCase
{
    private $repository;
    private $manager;

    public function setUp()
    {
        $this->repository = $this->getMockBuilder(ShorturlRepository::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['findByCode', 'save'])
                     ->getMock();

        $this->manager = new ShorturlManager($this->repository);
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
        $short = new ShorturlEntity();

        $this->repository->expects($this->once())
            ->method('save')
            ->with($short);

        $this->manager->save($short);

        $this->assertRegExp('/[\w]{6}/', $short->getCode());
    }
}
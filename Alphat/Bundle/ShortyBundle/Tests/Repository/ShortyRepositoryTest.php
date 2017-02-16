<?php

namespace Tests\Alphat\Bundle\ShortyBundle\Repository;

use Alphat\Bundle\ShortyBundle\Entity\ShortyEntity;
use Alphat\Bundle\ShortyBundle\Repository\ShortyRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;

class ShortyRepositoryTest extends \PHPUnit_Framework_TestCase
{
    private $em;
    private $meta;
    private $repository;

    public function setUp()
    {
        $this->em = $this->getMockBuilder(EntityManager::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['persist', 'flush'])
                     ->getMock();
        $this->meta = $this->getMockBuilder(ClassMetadata::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $this->repository = new ShortyRepository($this->em, $this->meta);
    }

    public function testSave()
    {
        $short = new ShortyEntity();

        $this->em->expects($this->once())
            ->method('persist')
            ->with($short);


        $this->em->expects($this->once())
            ->method('flush')
            ->with();

        $this->repository->save($short);
    }
}

<?php

namespace Tests\AppBundle\Repository;

use AppBundle\Entity\ShortyGeneratedEntity;
use AppBundle\Repository\ShortyGeneratedRepository;
use Doctrine\DBAL\Driver\DriverException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class ShortyGeneratedRepositoryTest extends \PHPUnit_Framework_TestCase
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

        $this->entityReposity = $this->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new ShortyGeneratedRepository($this->em, $this->meta);
    }

    public function testSave()
    {
        $short = new ShortyGeneratedEntity();

        $this->em->expects($this->once())
            ->method('persist')
            ->with($short);


        $this->em->expects($this->once())
            ->method('flush')
            ->with();

        $result =$this->repository->save($short);
        $this->assertTrue($result);
    }

    public function testSaveException()
    {
        $short = new ShortyGeneratedEntity();

        $this->em->method('persist')
            ->with($short);

        $result = $this->repository->save($short);
        $this->assertTrue($result);
    }

    public function testFindLast()
    {
        $this->markTestSkipped('to be implemented');
        $this->entityReposity->expects($this->once())
            ->method('createQueryBuilder');


        $this->repository->findLast();
    }

    public function testFindUnusedOne()
    {
        $this->markTestSkipped('to be implemented');

        $this->entityReposity->expects($this->once())
            ->method('findOneBy')
            ->with(['is_used' => false]);

        $this->repository->findUnusedOne();
    }
}

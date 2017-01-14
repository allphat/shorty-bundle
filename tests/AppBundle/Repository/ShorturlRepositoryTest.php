<?php

namespace Tests\AppBundle\Repository;

use AppBundle\Entity\ShorturlEntity;
use AppBundle\Repository\ShorturlRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;

class ShorturlRepositoryTest extends \PHPUnit_Framework_TestCase
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
             
        $this->repository = new ShorturlRepository($this->em, $this->meta);
    }

    public function testSave()
    {
        $short = new ShorturlEntity();

        $this->em->expects($this->once())
            ->method('persist')
            ->with($short);


        $this->em->expects($this->once())
            ->method('flush')
            ->with();

        $this->repository->save($short);
    }
}

<?php

namespace Tests\Allphat\ShortyBundle\Manager;

use Allphat\ShortyBundle\Entity\ShortyEntity;
use Allphat\ShortyBundle\Manager\ShortyManager;
use Allphat\ShortyBundle\Repository\ShortyRepository;


class ShortyManagerTest extends \PHPUnit\Framework\TestCase
{
    /** @phpstan-ignore-next-line */
    private $repository = null;
    
    /** @phpstan-ignore-next-line */
    private $manager = null;
    
    public function setUp(): void
    {
        $this->repository = $this->getMockBuilder(ShortyRepository::class)
                     ->disableOriginalConstructor()
                     ->setMethods(['findByCode', 'save', 'findUnusedOne', 'persist'])
                     ->getMock();

        $this->manager = new ShortyManager($this->repository);
    }

    public function testEncode(): void
    {
        $this->assertMatchesRegularExpression('/\w{6}/', $this->manager->encodeString());
    }

    public function testCreateEntity(): void
    {
        $result = $this->manager->createEntity();

        $this->assertFalse($result->getIsUsed());
    }

    public function testCreateAndUseEntity(): void
    {
        $result = $this->manager->createAndUseEntity();

        $this->assertTrue($result->getIsUsed());
    }

    public function testSaveNoDb(): void
    {
        $result = $this->manager->save();

        $this->assertTrue($result->getIsUsed());
		$this->assertMatchesRegularExpression('/\w{6}/', $result->getCode());
    }

    public function testSaveKnown(): void
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

    public function testSaveNew(): void
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
        $this->assertMatchesRegularExpression('/\w{6}/', $result->getCode());
    }
    
    public function testUpdateCounter()
    {
    	$shortyEntity = new SHortyEntity();
    	
    	$this->repository->expects($this->once())
            ->method('persist');

        $this->repository->expects($this->once())
            ->method('save');
    	
    	$result = $this->manager->updateCounter($shortyEntity);
    	
    	$this->assertEquals(1, $result->getCounter());
    }
}
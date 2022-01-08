<?php

namespace Allphat\ShortyBundle\Manager;

use Allphat\ShortyBundle\Entity\ShortyEntity;
use Allphat\ShortyBundle\Repository\ShortyRepository;
use Allphat\ShortyBundle\Shortener\Shortener;

class ShortyManager
{
	/**
	 * @var ShortyRepository
	 */
	private $shortyRepository;

	public function __construct(ShortyRepository $shortyRepository)
	{
		$this->shortyRepository = $shortyRepository;
	}

	public function findByCode(string $code, bool $allow_secure_only): ?ShortyEntity
	{
		return $this->shortyRepository->getByCode(['code' => $code, 'allow_secure_only' => $allow_secure_only]);
	}

	public function createEntity(): ShortyEntity
	{
		$short = new ShortyEntity();
        $short->setCreatedAt((new \DateTime())->getTimestamp());
		$short->setCode($this->encodeString());
		$short->setIsUsed(false);

		$this->shortyRepository->persist($short);

		return $short;
	}

	public function createAndUseEntity(): ShortyEntity
	{
		$short = new ShortyEntity();
        $short->setCreatedAt((new \DateTime())->getTimestamp());
		$short->setCode($this->encodeString());
		$short->setIsUsed(true);

		return $short;
	}

	public function save(): ShortyEntity
	{
		$short = $this->createAndUseEntity();

		$shorted = $this->shortyRepository->findUnusedOne();
		if (!is_null($shorted)) {
			$short = $shorted;
		}
		$short->setIsUsed(true);

		$this->shortyRepository->persist($short);
		$this->shortyRepository->save();

		return $short;
	}
	
	public function updateCounter(ShortyEntity $short): ShortyEntity
	{
        $short->incrementCounter();
        
        $this->shortyRepository->persist($short);
        $this->shortyRepository->save();
        
        return $short;
	}

	public function encodeString(): string
	{
		return Shortener::generateRandomCode();
	}
}
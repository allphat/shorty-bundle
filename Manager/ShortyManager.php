<?php

namespace Allphat\Bundle\ShortyBundle\Manager;

use Allphat\Bundle\ShortyBundle\Entity\ShortyEntity;
use Allphat\Bundle\ShortyBundle\Repository\ShortyRepository;
use Allphat\Bundle\ShortyBundle\Shortener\Shortener;

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

	public function findByCode(string $code): ?ShortyEntity
	{
		return $this->shortyRepository->findOneBy(['code' => $code]);
	}

	public function createEntity(): ShortyEntity
	{
		$short = new ShortyEntity();
        $short->setCreatedAt((new \DateTime())->getTimestamp());
		$short->setCode($this->encode());
		$short->setIsUsed(false);

		$this->shortyRepository->persist($short);

		return $short;
	}

	public function createAndUseEntity(): ShortyEntity
	{
		$short = new ShortyEntity();
      $short->setCreatedAt((new \DateTime())->getTimestamp());
		$short->setCode($this->encode());
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

	public function encode(): string
	{
		return Shortener::generateRandomCode();
	}
}
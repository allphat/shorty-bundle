<?php

namespace Allĥat\Bundle\ShortyBundle\Manager;

use Allĥat\Bundle\ShortyBundle\Entity\ShortyEntity;
use Allĥat\Bundle\ShortyBundle\Repository\ShortyRepository;
use Allĥat\Bundle\ShortyBundle\Shortener\Shortener;

class ShortyManager
{
	private $shortyRepository;

	/**
	 * @param ShortyRepository $repository
	 */
	public function __construct(ShortyRepository $shortyRepository)
	{
		$this->shortyRepository = $shortyRepository;
	}


	/**
	 * @param  string $code
	 * @return ShortyEntity
	 */
	public function findByCode($code)
	{
		return $this->shortyRepository->findByCode($code)[0];
	}

	/**
	 * [createEntity description]
	 * @return ShortyEntity $short
	 */
	public function createEntity()
	{
		$short = new ShortyEntity();
        $short->setCreatedAt((new \DateTime())->getTimestamp());
		$short->setCode($this->encode());
		$short->setIsUsed(false);

		$this->shortyRepository->persist($short);

		return $short;
	}

	/**
	 * creates an entity
	 * @return [type] [description]
	 */
	public function createAndUseEntity()
	{
		$short = new ShortyEntity();
        $short->setCreatedAt((new \DateTime())->getTimestamp());
		$short->setCode($this->encode());
		$short->setIsUsed(true);

		return $short;
	}


	/**
	 * [saveEntity description]
	 */
	public function saveEntity()
	{
		$this->shortyRepository->save();
	}


	/**
	 *
	 * @param  boolean $useDb param passed by config
	 * @return ShortyEntity $short
	 */
	public function save($useDb)
	{
		$short = $this->createAndUseEntity();

		if ($useDb) {
			$shorted = $this->shortyRepository->findUnusedOne();
			if (!is_null($shorted)) {
				$short = $shorted;
			}
			$short->setIsUsed(true);

			$this->shortyRepository->persist($short);
			$this->saveEntity();
		}

		return $short;
	}


	/**
	 * creates a 6 characters string
	 *
	 * @return string
	 */
	public function encode()
	{
		return Shortener::generateRandomCode();
	}
}


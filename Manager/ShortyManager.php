<?php

namespace Alphat\Bundle\ShortyBundle\Manager;

use Alphat\Bundle\ShortyBundle\Entity\ShortyEntity;
use Alphat\Bundle\ShortyBundle\Repository\ShortyRepository;
use Alphat\Bundle\ShortyBundle\Shortener\Shortener;

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
	 * [save description]
	 * @return [type] [description]
	 */
	public function save()
	{
		$shorted = $this->shortyRepository->findUnusedOne();
		if (is_null($shorted)) {
			$short = new ShortyEntity();
            $short->setCreatedAt((new \DateTime())->getTimestamp());
			$short->setCode($this->encode());
		} else {
			$short = $shorted;
		}

		$short->setIsUsed(true);

		$this->shortyRepository->save($short);

		return $short;
	}


	/**
	 * creates a 6 characters string
	 *
	 * @return string
	 */
	public function encode()
	{
		return Shortener::generateRandomUri();
	}
}

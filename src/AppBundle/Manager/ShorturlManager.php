<?php

namespace AppBundle\Manager;

use AppBundle\Entity\ShorturlEntity;
use AppBundle\Repository\ShorturlRepository;
use AppBundle\Shortener\Shortener;

class ShorturlManager
{
	private $repository;

	/**
	 * @param ShorturlRepository $repository
	 */
	public function __construct(ShorturlRepository $repository)
	{
		$this->repository = $repository;
	}


	/**
	 * @param  string $code
	 * @return ShorturlEntity
	 */
	public function findByCode($code)
	{
		return $this->repository->findByCode($code)[0];
	}

	/**
	 * @param  ShorturlEntity  $short
	 */
	public function save(ShorturlEntity $short)
	{
		$short->setCode($this->encode());
		$this->repository->save($short);
	}

  
	/**
	 * creates a 6 characters string
	 * 
	 * @return string
	 */
	public function encode()
	{
		return Shortener::generateLittleCode();
	}

	/**
	 * @param  ShorturlEntity $short
	 */
	public function updateCounter(ShorturlEntity $short)
	{
		$short->setCounter(($short->getCounter()+1));
		$this->repository->save($short);
	}
}

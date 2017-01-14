<?php

namespace AppBundle\Manager;

use AppBundle\Repository\ShorturlRepository;
use AppBundle\Shortener\Shortener;

class ShorturlManager
{
	private $repository;

	/**
	 * store dico as array for eas of use
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
	 * @param  ShorturlEntity $short
	 * @return [type]        [description]
	 */
	public function save($short)
	{
		$short->setCode($this->encode());
		$this->repository->save($short);
	}

  
	/**
	 * creates a 6 characters string
	 * 
	 * @return [type]         [description]
	 */
	public function encode()
	{
		return Shortener::generateLittleCode();
	}

}

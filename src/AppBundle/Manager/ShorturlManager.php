<?php

namespace AppBundle\Manager;

use AppBundle\Repository\ShorturlRepository;

class ShorturlManager
{
	const DICO = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	const MAX_SIZE = 6;

	private $repository;

	/**
	 * store dico as array for eas of use
	 */
	public function __construct(ShorturlRepository $repository)
	{
		$this->repository = $repository;
		$this->dico = str_split(self::DICO);
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
		$this->repository->save($short);
	}

  
	/**
	 * creates a 6 characters string
	 * 
	 * @return [type]         [description]
	 */
	public function encode()
	{
		$i = self::MAX_SIZE;
		$return = '';
		while ($i > 0) {
			$return .= $this->dico[rand(0, count($this->dico))];
			$i--;	
		}

		return $return;
	}

}

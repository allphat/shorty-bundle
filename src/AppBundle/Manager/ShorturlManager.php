<?php

namespace AppBundle\Manager;


class ShorturlManager
{
	const DICO = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	const MAX_SIZE = 6;

    /**
     * store dico as array for eas of use
     */
	public function __construct()
	{
		$this->dico = str_split(self::DICO);
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

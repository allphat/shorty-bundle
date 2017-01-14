<?php

namespace AppBundle\Shortener;

class Shortener
{
    const DICO = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    const MAX_SIZE = 6;

    /**
     * generate an alphanum code on MAX_SIZE characters
     * @return [type] [description]
     */
    public static function generateLittleCode()
    {
        
        $arrayDico = str_split(self::DICO);
        $i = self::MAX_SIZE;
        $return = '';
        while ($i > 0) {
            $return .= $arrayDico[rand(0, count($arrayDico))];
            $i--;   
        }

        return $return;
    }
    
}

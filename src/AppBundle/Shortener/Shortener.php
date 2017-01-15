<?php

namespace AppBundle\Shortener;

class Shortener
{
    const DICO = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    const MAX_SIZE = 6;

    /**
     * generate an alphanum code on MAX_SIZE characters
     * @return string $return
     */
    public static function generateLittleCode()
    {
        $return = '';
        $arrayDico = str_split(self::DICO);
        $dicoSize = count($arrayDico) - 1;
        $i = self::MAX_SIZE;
        while ($i > 0) {
            $return .= $arrayDico[random_int(0, $dicoSize)];
            $i--;
        }

        return str_shuffle($return);
    }

}

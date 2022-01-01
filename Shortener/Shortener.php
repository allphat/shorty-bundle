<?php

namespace Allphat\Bundle\ShortyBundle\Shortener;

class Shortener
{
    const DICO = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    const MAX_SIZE = 6;

    /**
     * generate an alphanum code on MAX_SIZE characters
     * @return string $return
     */
    public static function generateRandomCode()
    {
        $return = '';
        $i = self::MAX_SIZE;
        $dico = self::DICO;
        while ($i > 0) {
            $return .= $dico[random_int(0, 61)];
            $i--;
        }

        return $return;
    }
}
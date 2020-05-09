<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str):string
    {
        // $explode = explode(' ', $str);
        // $reverse = array_reverse($explode);
        // $implode = implode(' ', $reverse);
        // $result = ucfirst($implode);
        return ucfirst(implode(' ', array_reverse(explode(' ', $str))));
    }
}

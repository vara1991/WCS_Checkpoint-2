<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{
    public static function yodalizeIt(string $str):string
    {
        //TODO Write your code here,
        //TODO And return what we are waiting for at the end...
        $explode = explode(' ', $str);
        $reverse = array_reverse($explode);
        $string = implode(' ', $reverse);
        return ucfirst($string);
    }

}

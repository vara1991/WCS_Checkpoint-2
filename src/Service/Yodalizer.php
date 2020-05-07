<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str): string
    {
        //TODO Write your code here,
        $string = "I feel fear here";

        $explode = explode(" ", $string);
        $reverse = array_reverse($explode);
        $implode = implode(" ", $reverse);

        //TODO And return what we are waiting for at the end...
        return ucfirst($implode);
    }
}

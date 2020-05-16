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
        $explode = explode(' ', $str);
        $reverse = array_reverse($explode);
        $implode = implode(' ', $reverse);
        $yodaWords = ucfirst($implode);

        //TODO And return what we are waiting for at the end...
        return $yodaWords;
    }
}

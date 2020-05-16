<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str):string
    {
        $explode = explode(' ', $str);
        $reverse = array_reverse($explode);
        $implode = implode(' ', $reverse);
        $yodaWords = ucfirst($implode);
   return $yodaWords;
        //TODO Write your code here,
        
        echo ucfirst();
        echo ucwords();
        //TODO And return what we are waiting for at the end...
    }
}

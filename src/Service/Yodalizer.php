<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str):string
    {
       $explode = explode(" ",$str);
       $results = array_reverse($explode);

       $result = implode(" ,$results");
       return ucfirst($result);
        echo (yodalizeIt($str));
    }
}

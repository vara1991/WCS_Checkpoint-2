<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str):string
    {
        $result = explode(' ', $str);
        $reverse = array_reverse($result);
        $word = implode(' ', $reverse);
        return ucfirst($word);
    }
}

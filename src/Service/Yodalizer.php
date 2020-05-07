<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{
    public static function yodalizeIt(string $str):string
    {
        return implode(' ', array_reverse(explode(' ', $str)));
    }
}

// EN DEHORS DE LA CLASSE
$str = "I feel power here";
echo ucfirst(yodalizeIt($str));
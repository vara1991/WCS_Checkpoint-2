<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public $param="i feel fear here";

    public static function yodalizeIt($str)
    {
        //TODO Write your code here,
        //TODO And return what we are waiting for at the end...

        return ucfirst(implode(' ',array_reverse(explode(' ', $str))));

    }


}

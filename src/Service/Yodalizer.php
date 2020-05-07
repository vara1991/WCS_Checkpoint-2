<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt($str){
        $explode = explode(' ', $str);
        $explodeReverse = array_reverse($explode);
        $result = '';
        foreach ($explodeReverse as $word){
            $result .= $word. ' ';
        }
        ucfirst($result);
        return $result;
    }
}

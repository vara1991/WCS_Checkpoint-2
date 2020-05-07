<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str):string
    {
        $string = "Je suis le padawan Jimmy";
        function yodalizeIt($param){

            $result = explode(' ',$param);
            $reverse = array_reverse($result);
            $sentence = implode(' ', $reverse);
            echo $sentence;
        }
        return(yodalizeIt($string));
    }

return(yodalizeIt($string));

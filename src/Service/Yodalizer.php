<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str):string
    {
        // transforme la strin en tableau 
        $xplode = explode(' ', $str);
        // inverse array
        $reverse = array_reverse($xplode);
        $array = [];
        for($i = 0; $i < count($reverse); $i++){
            if($i == 0){
                array_push($array, ucfirst($reverse[$i]));
                
            } else {
                array_push($array, $reverse[$i]);
            }
        }
        return implode(' ', $array); 
    }
}

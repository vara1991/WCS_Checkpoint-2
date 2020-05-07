<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str):string
    {
        // transforme la string en array 
        $xplode = explode(' ', $str);
        // inverse array
        $reverse = array_reverse($xplode);
        // prepare new array of result 
        $array = [];
        // loop on reverse
        for($i = 0; $i < count($reverse); $i++){
            // for i = 0 (first word) always put majuscule && push in it on new array
            if($i == 0){
                array_push($array, ucfirst($reverse[$i]));
                
            } else {
                // for other i, always push in new array
                array_push($array, $reverse[$i]);
            }
        }
        // finaly use implode to get string with values of new array and return result of it
        return implode(' ', $array); 
    }
}

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
        //$expl = explode(' ', $str);
        // inverse array
        //$reverse = array_reverse($expl);
        // Premiere lettre du premier mot en majuscule
        //$reverse[0] = ucfirst($reverse[0]);
        // finaly use implode to get string with values of reversed array and return result of it
        //implode(' ', $reverse); 
        
        return ucfirst(implode(' ', array_reverse(explode(' ', $str))));
    }
}

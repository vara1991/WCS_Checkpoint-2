<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str):string
    {
        //TODO Write your code here,
        //TODO And return what we are waiting for at the end...
        $explode = explode(" ",$str);
        $results = array_reverse($explode);
        $resultat = "";
        foreach($results as $result ){
            $resultat .= $result." ";}
        return ucfirst($resultat);
    }
}

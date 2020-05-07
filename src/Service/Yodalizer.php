<?php

namespace App\Service;

/**
 *  class Yodalizer
 */
class Yodalizer
{

    public static function yodalizeIt(string $str)
    {
        //TODO Write your code here,
        //TODO And return what we are waiting for at the end...


        $words = explode(' ', $str);

        foreach ($words as $word) {
            $wordsLength[$word] = strlen($word);
        }

        if ('ASC' == $str) {
            asort($wordsLength);
        } elseif ('DESC' == $str) {
            arsort($wordsLength);
        } else {
            return false;
        }

        $wordsLength = array_flip($wordsLength);
        $result = implode(' ', $wordsLength);

        return $result;
        
    }
}

<?php

namespace MyApp\Utils;

class Strings {

    static function translateDate($string, $length) {

        $translations = 
        [
            'short' => 
            [
                'gen' => 'jan',
                'feb' => 'feb',
                'mar' => 'mar',
                'apr' => 'apr',
                'mag' => 'may',
                'giu' => 'jun',
                'lug' => 'jul',
                'aug' => 'aug',
                'set' => 'sep',
                'ott' => 'oct',
                'nov' => 'nov',
                'dic' => 'dec'
            ],
            'full' => 
            [
                'gennaio' => 'january',
                'febbraio' => 'february',
                'marzo' => 'march',
                'aprile' => 'april',
                'maggio' => 'may',
                'giugno' => 'june',
                'luglio' => 'july',
                'august' => 'august',
                'settembre' => 'september',
                'ottobre' => 'october',
                'novembre' => 'november',
                'dicembre' => 'december'        
            ]
        ];        

        $clean = strtolower(str_replace(' ORE ', ' ', trim($string)));

        $array = explode(' ', $clean);

        $day = $array[0];
        $month = $translations[$length][$array[1]];
        $year = $array[2];
        $hours = $array[3];

        return $day . ' ' . $month . ' ' . $year . ' ' . $hours;
    }    

    /*
    static private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    */

}




<?php

namespace App\Http\Utils;

class Name {
    public static function isSameName(
        string $first_name1, 
        string $last_name1, 
        string $first_name2, 
        string $last_name2){
            if ($first_name1 == $first_name2 && $last_name1 == $last_name2){
                return true;
            }
            return false;
    }
}
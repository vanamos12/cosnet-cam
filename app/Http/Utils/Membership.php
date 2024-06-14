<?php

namespace App\Http\Utils;

use App\Models\User;
use Illuminate\Support\Str;

class Membership {

    public static function genTempMembershipId(){
        $membershipid = 'TEMP'.strtoupper(Str::random(7));

        $continue = true;

        do {
            $number = User::where('membershipid', $membershipid)->count();
            if ($number == 0){ // Not already used matricule
                $continue = false;
            }else{
                $membershipid = 'TEMP'.strtoupper(Str::random(7));
            }

        }while($continue);

        return $membershipid;
        
    }
}
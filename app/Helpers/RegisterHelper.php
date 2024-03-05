<?php

namespace App\Helpers;
use App\Models\User;

class RegisterHelper
{

    public static function generateReferralId($letterLength , $numberLength ) {
        do {
            $letters = '';
            for ($i = 0; $i < $letterLength ; $i++) {
                $letters .= chr(rand(97, 122)); 
            }

            $numbers = str_pad(mt_rand(0, pow(10, $numberLength) - 1), $numberLength, '0', STR_PAD_LEFT);

            $referralId = $letters . $numbers;

            $existingReferralId = User::where('referral_id', $referralId)->exists();
        } while ($existingReferralId);

        return $referralId;
    }

    public static function generateUserId($user_type,$numberLength) {
        do {
            $userId = $user_type . str_pad(mt_rand(0, pow(10, $numberLength) - 1), $numberLength, '0', STR_PAD_LEFT); 

            $existingUserId = User::where('user_id', $userId)->exists();
        } while ($existingUserId);

        return $userId;
    }
}
 

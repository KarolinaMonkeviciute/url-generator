<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Url;

class generateUniqueHashService
{
    public static function generateUniqueHash(int $number): string{
        while(true){
            $hash = Str::random($number);
            if(!Url::query()->where('hash', $hash)->exists()){
                return $hash;
            }
        }
    }
}
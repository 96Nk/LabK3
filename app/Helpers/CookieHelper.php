<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class CookieHelper
{
    public static string $namecookie = 'TEST-MODULES';
    public static string $keyCache = 'cache-modules';


    public static function setCookie(string $value): void
    {
        $minutes = (60 * 60 * 24 * 2); // 2 hari
        Cookie::make(name: self::$namecookie, value: $value, minutes: $minutes, httpOnly: true);
    }

    public static final function logAccess(): object|array
    {
        $token = Cookie::get(self::$namecookie);
        if (!$token) return [];
        return JwtHelper::decodeJwt($token);
    }

//    private function _setSession(string $cookie): void
//    {
//        if (!Cache::get(static::$keyCache)) {
//            $data = UserSession::where(['session' => $cookie])->first();
//            Cache::add(self::$keyCache, $data, 60);
//        }
//    }

}

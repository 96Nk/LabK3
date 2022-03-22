<?php

namespace App\Http\Services;

use App\Helpers\CookieHelper;
use App\Helpers\JwtHelper;
use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class AuthService
{
    private int|float $minutes;

    public function __construct()
    {
        $this->minutes = (60 * 60 * 24 * 2);
    }

    /**
     * @throws \Exception
     */
    public final function validation(string $username, string $password): array
    {
        $user = User::where('username', $username)->first();
        $jwt = JwtHelper::encodeJWT(['session_id' => Str::random(64), 'level_id' => $user['level_id']]);
        if (!Auth::attempt(['username' => $username, 'password' => $password])) throw new \Exception('Gagal Login.!!!');
        Cookie::queue(CookieHelper::$namecookie, $jwt, $this->minutes);
        return ResponseHelper::success('Login Berhasil');
    }

}

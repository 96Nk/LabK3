<?php

namespace App\Http\Services;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct()
    {
    }

    /**
     * @throws \Exception
     */
    public final function validation(string $username, string $password): array
    {
        $user = User::where('username', $username)->first();
        if (!$user or !Auth::attempt(['username' => $username, 'password' => $password])) throw new \Exception('Gagal Login.!!!');
        return ResponseHelper::success('Login Berhasil');
    }

}

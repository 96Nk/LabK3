<?php

namespace App\Http\Services;

use App\Helpers\ResponseHelper;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct()
    {
    }

    /**
     * @throws \Exception
     */
    public final function validation(string $username, string $password): bool
    {
        $user = User::where('username', $username)->first();
        if (!$user) throw new \Exception('login failed !!!');
        if ($user->is_active != 1) throw new \Exception('Your user is not active.');
        return Auth::attempt(['username' => $username, 'password' => $password]);
    }

}

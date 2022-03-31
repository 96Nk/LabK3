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
    public final function validation(string $username, string $password): array
    {
        $user = User::where('username', $username)->first();
        if (!$user or !Auth::attempt(['username' => $username, 'password' => $password])) throw new \Exception('Gagal Login.!!!');
        return ResponseHelper::success('Login Berhasil');
    }

    public final function registration(Request $request): \Illuminate\Database\Eloquent\Model|Company
    {
        $attributes = $request->validate([
            'company_name' => ['required'],
            'company_email' => ['required', 'unique:companies', 'email'],
            'company_phone' => ['required'],
            'company_address' => ['required'],
            'city_id' => ['required'],
            'district_id' => ['required'],
            'prov_id' => ['required'],
            'village_id' => ['required'],
        ]);
        return Company::create($attributes);
    }

}

<?php

namespace Modules\Settings\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{

    public function __construct()
    {
    }

    public final function addUser(Request $request): \Illuminate\Database\Eloquent\Model|User
    {
        $attr = $request->validate([
            'username' => ['required', 'unique:users'],
            'password' => ['required'],
            'name' => ['required'],
        ]);
        $data = [
            'username' => $attr['username'],
            'password' => $attr['password'],
            'name' => $attr['name'],
            'level_id' => $request->post('level_id'),
            'is_active' => $request->post('is_active'),
            'company_id' => $request->post('company_id'),
            'employee_id' => $request->post('employee_id'),
        ];
        return User::create($data);
    }

}

<?php

namespace Modules\Settings\Http\Services;

use App\Mail\NotifUserMail;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

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
            'is_active' => $request->post('is_active') ?? 1,
            'company_id' => $request->post('company_id'),
            'employee_id' => $request->post('employee_id'),
        ];
        return User::create($data);
    }

    public final function addUserCompany(Request $request, Company $company): \Illuminate\Database\Eloquent\Model|User
    {
        $data = [
            'username' => $request['company_email'],
            'password' => '123456',
            'name' => $request['company_name'],
            'level_id' => 2,
            'is_active' => 0,
            'company_id' => $company->company_id,
        ];
        return User::create($data);
    }

    public final function deleteUserCompany(string $username): ?bool
    {
        return User::where('username', $username)->delete();
    }

    /**
     * @throws \Exception
     */
    public final function forgetPasswordUser(Request $request): bool
    {
        $username = $request->post('username');
        $user = User::where('username', $username)->first();
        if (!$user) throw new \Exception('user not found');
        return $user->update(['password', $request->post('password')]);
    }

    /**
     * @throws \Exception
     */
    public final function verificationUser(Request $request): bool|int
    {
        $email = $request->username;
        $password = $request->password;
        $user = User::where('username', $email)->first();
        if (!$user) throw new \Exception('user not found');
        return $user->update(['is_active' => 1, 'password' => $password]);
    }

    /**
     * @throws \Exception
     */
    public final function resetPassword(Request $request): bool|int
    {
        $email = $request->username;
        $password = $request->password;
        $user = User::where('username', $email)->first();
        if (!$user) throw new \Exception('user not found');
        return $user->update(['password' => $password]);
    }

    public final function sendMailUser(Request $request): void
    {
        $mailData = [
            'title' => 'Notifikasi User Perusahaan',
            'body' => 'Tidak untuk di balas.',
            'username' => $request->post('username'),
            'password' => $request->post('password'),
        ];
        Mail::to($mailData['username'])->send(new NotifUserMail($mailData));
    }

}

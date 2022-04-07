<?php

namespace Modules\Settings\Http\Services;

use App\Mail\NotifUserMail;
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

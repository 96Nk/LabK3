<?php

namespace Modules\Company\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Mail\NotifUserMail;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use Modules\Settings\Http\Services\UserService;

class CompanyController extends Controller
{
    public function index()
    {
        $get['companies'] = Company::get();
        $get['random'] = \Str::lower(Str::random(8));
        return view('company::index', $get);
    }

    /**
     * @param Request $request
     * @param UserService $userService
     * @return \Illuminate\Http\RedirectResponse
     */
    public final function verification(Request $request, UserService $userService): \Illuminate\Http\RedirectResponse
    {
        try {
            $mailData = [
                'title' => 'Notifikasi User Perusahaan',
                'body' => 'Tidak untuk di balas.',
                'username' => $request->post('username'),
                'password' => $request->post('password'),
            ];
            Mail::to($mailData['username'])->send(new NotifUserMail($mailData));
            $userService->addUser($request);
            $response = ResponseHelper::success('Berhasil Verifikasi Data Perusahaan');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }
}

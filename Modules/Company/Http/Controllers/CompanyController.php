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
            $userService->sendMailUser($request);
            $userService->addUser($request);
            $response = ResponseHelper::success('Berhasil Verifikasi Data Perusahaan');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function resending(Request $request, UserService $userService)
    {
        try {
            $userService->sendMailUser($request);
            $userService->forgetPasswordUser($request);
            $response = ResponseHelper::success('Berhasil mengirim ulang email');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function destroy(Company $company)
    {
        try {
            $bool = $company->destroy($company['company_id']);
            if (!$bool) throw new \Exception('Gagal Menghapus Data');
            $response = ResponseHelper::success('Berhasil delete data');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}

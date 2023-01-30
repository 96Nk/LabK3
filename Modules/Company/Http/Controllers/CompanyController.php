<?php

namespace Modules\Company\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Company\Http\Services\CompanyService;
use Modules\Settings\Http\Services\UserService;

class CompanyController extends Controller
{

    public function __construct(
        private CompanyService $companyService,
        private UserService    $userService
    )
    {
    }

    public function index()
    {
        $get['companies'] = Company::with('user')->get();
        $get['random'] = \Str::lower(Str::random(8));
        return view('company::index', $get);
    }

    public final function verification(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->userService->sendMailUser($request);
            $this->userService->verificationUser($request);
            $response = ResponseHelper::success('Berhasil Verifikasi Data Perusahaan');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function reset(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->userService->sendMailUser($request);
            $this->userService->resetPassword($request);
            $response = ResponseHelper::success('Berhasil Reset Password Perusahaan');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function resending(Request $request)
    {
        try {
            $this->userService->sendMailUser($request);
            $this->userService->forgetPasswordUser($request);
            $response = ResponseHelper::success('Berhasil mengirim ulang email');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function update(Request $request, Company $company)
    {
        try {
            $bool = $this->companyService->updateCompany($request, $company['company_id']);
            if (!$bool) throw new \Exception('Gagal Update Data');
            $response = ResponseHelper::success('Berhasil Update data');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    /**
     * @throws \Throwable
     */
    public final function destroy(Company $company)
    {
        DB::beginTransaction();
        try {
            $bool = $company->destroy($company['company_id']);
            if (!$bool) throw new \Exception('Gagal Menghapus Data');
            $this->userService->deleteUserCompany($company['company_email']);
            DB::commit();
            $response = ResponseHelper::success('Berhasil delete data');
        } catch (\Exception $exception) {
            DB::rollBack();
            $response = ResponseHelper::error($exception->getMessage());
        } catch (\Throwable $e) {
            DB::rollback();
            $response = ResponseHelper::error($e->getMessage());
        }
        return response()->json($response);
    }
}

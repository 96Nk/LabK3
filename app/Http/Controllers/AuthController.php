<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Services\AuthService;
use App\Models\RefProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Company\Http\Services\CompanyService;
use Modules\Settings\Http\Services\UserService;

class AuthController extends Controller
{
    public function __construct(
        private UserService $userService
    )
    {
    }

    public final function login(): \Illuminate\Contracts\View\View
    {
        return view('auth.login');
    }

    public final function registration(): \Illuminate\Contracts\View\View
    {
        $get['provinces'] = RefProvince::all();
        return view('auth.registration', $get);
    }


    /**
     * @param Request $request
     * @param AuthService $authService
     * @return \Illuminate\Http\JsonResponse|array
     */
    public final function validation(Request $request, AuthService $authService): \Illuminate\Http\JsonResponse|array
    {
        try {
            $attributes = $request->validate([
                'username' => ['required'],
                'password' => ['required', 'min:3'],
            ]);
            $authService->validation($attributes['username'], $attributes['password']);
            $response = ResponseHelper::success('Login Berhasil');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    /**
     * @param Request $request
     * @param CompanyService $companyService
     * @return \Illuminate\Http\RedirectResponse
     */
    public final function registrationStore(Request $request, CompanyService $companyService): \Illuminate\Http\RedirectResponse
    {
        try {
            $company = $companyService->addCompany($request);
            if (!$company) throw new \Exception('failed to enter company data');
            $this->userService->addUserCompany($request, $company);
            $response = ResponseHelper::success('Registration complete.');
            $this->setFlash($response['message'], $response['status']);
            return redirect()->route('login');
        } catch (\Exception $exception) {
            if ($exception instanceof \PDOException) {
                $message = 'Duplicate entre. the data you entered is already in the database';
            } else {
                $message = $exception->getMessage();
            }
            $response = ResponseHelper::error($message);
            $this->setFlash($response['message'], $response['status']);
            return redirect()->back();
        }
    }

    public final function logout(): \Illuminate\Http\JsonResponse
    {
        try {
            Auth::logout();
            $response = ResponseHelper::success('Berhasil Logout.');
        } catch (\Exception $e) {
            $response = ResponseHelper::error($e->getMessage());
        }
        return response()->json($response);
    }
}

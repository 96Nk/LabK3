<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Services\AuthService;
use App\Models\RefProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Company\Http\Services\CompanyService;

class AuthController extends Controller
{
    public function __construct()
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
                'username' => ['required', 'alpha_num'],
                'password' => ['required', 'min:3'],
            ]);
            $response = $authService->validation($attributes['username'], $attributes['password']);
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
            $companyService->addCompany($request);
            $response = ResponseHelper::success('Registration complete.');
            $this->setFlash($response['message'], $response['status']);
            return redirect()->route('login');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
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

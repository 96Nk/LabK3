<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Services\AuthService;
use App\Models\RefProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public final function login()
    {
        return view('auth.login');
    }

    public final function registration()
    {
        $get['provinces'] = RefProvince::all();
        return view('auth.registration', $get);
    }


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

    public final function registrationStore(Request $request, AuthService $authService)
    {
        try {
            $authService->registration($request);
            $response = ResponseHelper::success('Registration complete.');
            $this->setFlash($response['message'], $response['status']);
            return redirect()->route('login');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
            $this->setFlash($response['message'], $response['status']);
            return redirect()->back();
        }

    }

    public final function logout()
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

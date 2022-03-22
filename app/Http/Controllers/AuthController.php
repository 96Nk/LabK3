<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public final function login()
    {
        return view('auth.login');
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
}

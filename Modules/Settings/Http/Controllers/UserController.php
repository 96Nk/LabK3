<?php

namespace Modules\Settings\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\RefEmployee;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Settings\Http\Services\UserService;

class UserController extends Controller
{


    public function __construct(
        private UserLevel $userLevel
    )
    {
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $get = [
            'level_id' => $request->get('level'),
            'user_levels' => $this->userLevel->get(),
            'users' => User::where('level_id', $request->get('level'))->get(),
            'employees' => RefEmployee::all()
        ];
        return view('settings::user.index', $get);
    }

    public function store(Request $request, UserService $userService)
    {
        try {
            $userService->addUser($request);
            $response = ResponseHelper::success('Berhasil.');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

}

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

    public final function index(Request $request)
    {
        $get = [
            'level_id' => $request->get('level'),
            'user_levels' => $this->userLevel->get(),
            'users' => User::where('level_id', $request->get('level'))->get(),
            'employees' => RefEmployee::all()
        ];
        return view('settings::user.index', $get);
    }

    /**
     * @param Request $request
     * @param UserService $userService
     * @return \Illuminate\Http\RedirectResponse
     */
    public final function store(Request $request, UserService $userService): \Illuminate\Http\RedirectResponse
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

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public final function updateActive(User $user): \Illuminate\Http\JsonResponse
    {
        try {
            $data = ['is_active' => $user->is_active == 1 ? 0 : 1];
            $status = $user->update($data);
            $response = ResponseHelper::statusAction('Update Is Active User.', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public final function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        try {
            $user->delete();
            $response = ResponseHelper::success();
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}

<?php

namespace Modules\Utility\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\UtiActivity;
use App\Models\UtiLetterSigner;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Utility\Http\Requests\SignerRequest;
use Modules\Utility\Http\Services\ActivityService;
use Modules\Utility\Http\Services\SignerService;

class ActivityController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $activities = UtiActivity::all();
        return view('utility::activity.index', compact('activities'));
    }

    public function store(Request $request, ActivityService $activityService)
    {
        try {
            $id = $request->post('activity_id');
            $id ? $activityService->updateActivity($request, $id)
                : $activityService->addActivity($request);
            $this->setFlash('Input Data Activity', true);
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
        }
        return back();
    }

    public function destroy(UtiActivity $activity)
    {
        try {
            $status = $activity->delete();
            $response = ResponseHelper::statusAction('Delete data activity', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}

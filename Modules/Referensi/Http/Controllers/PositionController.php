<?php

namespace Modules\Referensi\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\RefPosition;
use Illuminate\Http\Request;
use Modules\Referensi\Http\Requests\PositionRequest;
use Modules\Referensi\Http\Services\PositionService;

class PositionController extends Controller
{
    public function __construct(
        private PositionService $positionService
    )
    {
    }

    public function index()
    {
        $get = [
            'positions' => RefPosition::all()
        ];
        return view('referensi::position.index', $get);
    }

    public final function store(PositionRequest $request)
    {
        try {
            $id = $request->post('position_id');
            $status = $id ?
                $this->positionService->updatePosition($request) :
                (bool)$this->positionService->addPosition($request);
            $response = ResponseHelper::statusAction($id ? "Update data Position" : "Input data Position", $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public function destroy(RefPosition $refPosition)
    {
        try {
            $status = $refPosition->delete();
            $response = ResponseHelper::statusAction('Delete data Position', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        return response()->json($response);
    }
}

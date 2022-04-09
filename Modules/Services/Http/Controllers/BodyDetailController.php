<?php

namespace Modules\Services\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\ServiceBody;
use App\Models\ServiceHead;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Services\Http\Requests\BodyRequest;
use Modules\Services\Http\Requests\DetailRequest;
use Modules\Services\Http\Services\BodyService;

class BodyDetailController extends Controller
{

    public function __construct(private BodyService $bodyService)
    {
    }

    public function index(Request $request)
    {
        $get = [
            'head_id' => $request->get('head'),
            'heads' => ServiceHead::all(),
            'bodies' => ServiceBody::all(),
        ];
        return view('services::body_detail.index', $get);
    }


    public function storeBody(BodyRequest $request)
    {
        try {
            $status = (bool)$this->bodyService->addBody($request);
            $response = ResponseHelper::statusAction('Input data Service Body', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public function storeDetail(DetailRequest $request)
    {

    }

    public function destroyBody(ServiceBody $serviceBody)
    {
        try {
            $status = $serviceBody->delete();
            $response = ResponseHelper::statusAction('Delete data Service Body', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}

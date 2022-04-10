<?php

namespace Modules\Services\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\ServiceBody;
use App\Models\ServiceDetail;
use App\Models\ServiceHead;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Services\Http\Requests\BodyRequest;
use Modules\Services\Http\Requests\DetailRequest;
use Modules\Services\Http\Services\BodyService;
use Modules\Services\Http\Services\DetailService;

class BodyDetailController extends Controller
{

    public function __construct(private BodyService $bodyService, private DetailService $detailService)
    {
    }

    public function index(Request $request)
    {
        $get = [
            'head_id' => $request->get('head'),
            'heads' => ServiceHead::all(),
            'bodies' => ServiceBody::all(),
            'details' => ServiceDetail::all(),
        ];
        return view('services::body_detail.index', $get);
    }


    public function storeBody(BodyRequest $request)
    {
        try {
            $id = $request->post('service_body_id');
            $status = $id
                ? $this->bodyService->updateBody($request)
                : (bool)$this->bodyService->addBody($request);
            $response = ResponseHelper::statusAction($id ? 'Update data Service Body' : 'Input data Service Body', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public function storeDetail(DetailRequest $request)
    {
        try {
            $id = $request->post('service_detail_id');
            $status = $id
                ? $this->detailService->updateDetail($request)
                : (bool)$this->detailService->addDetail($request);
            $response = ResponseHelper::statusAction($id ? 'Update data Service Detail' : 'Input data Service Detail', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
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


    public function destroyDetail(ServiceDetail $serviceDetail)
    {
        try {
            $status = $serviceDetail->delete();
            $response = ResponseHelper::statusAction('Delete data Service Detail', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}

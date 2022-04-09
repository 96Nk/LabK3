<?php

namespace Modules\Services\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\ServiceHead;
use Illuminate\Http\Request;
use Modules\Services\Http\Requests\HeadRequest;
use Modules\Services\Http\Services\HeadService;

class HeadController extends Controller
{
    public function __construct(private HeadService $headService)
    {
    }

    public function index()
    {
        $get = [
            'heads' => ServiceHead::all()
        ];
        return view('services::head.index', $get);
    }

    public function store(HeadRequest $request)
    {
        try {
            $id = $request->post('service_head_id');
            $status = $id ?
                $this->headService->updateHead($request) :
                (bool)$this->headService->addHead($request);
            $response = ResponseHelper::statusAction($id ? 'Update data Service Head  ' : 'Input data Service Head', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public function destroy(ServiceHead $serviceHead)
    {
        try {
            $status = $serviceHead->delete();
            $response = ResponseHelper::statusAction('Delete data Service Head', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}

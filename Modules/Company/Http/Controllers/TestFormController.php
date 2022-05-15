<?php

namespace Modules\Company\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\ServiceHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Company\Http\Services\FormDetailService;

class TestFormController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $get['company'] = auth()->user()['company'];
        $get['services'] = ServiceHead::get();
        return view('company::test.form', $get);
    }

    public final function store(Request $request, FormDetailService $formDetailService)
    {

        try {
            DB::beginTransaction();
            $formDetailService->addFormService($request);
            $data = $formDetailService->addForm($request);
            $response = ResponseHelper::success(data: $data->fresh()->toArray());
            DB::commit();
            $this->setFlash($response['message'], $response['status']);
            return to_route('test.application');
        } catch (\Exception $exception) {
            DB::rollBack();
            $response = ResponseHelper::error($exception->getMessage());
            $this->setFlash($response['message'], $response['status']);
        }

    }

}

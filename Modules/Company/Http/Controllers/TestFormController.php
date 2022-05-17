<?php

namespace Modules\Company\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormService;
use App\Models\ServiceHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Company\Http\Services\FormDetailService;

class TestFormController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $company = auth()->user()['company'];
        $services = ServiceHead::get();
        return view('company::test.add_form', compact('company', 'services'));
    }

    public function edit(Form $form)
    {
        $company = auth()->user()['company'];
        $services = ServiceHead::get();
//        $form = Form::with(['form_services'])->where('form_code', $form_code)->first();
        return view('company::test.update_form', compact('form', 'company', 'services'));
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

    public final function update(Request $request, Form $form, FormDetailService $formDetailService)
    {
        try {
            DB::beginTransaction();
            $formDetailService->addFormService($request);
            $status = $formDetailService->updateForm($request, $form);
            DB::commit();
            $this->setFlash('Success', $status);
            return to_route('test.application');
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->setFlash($exception->getMessage());
            return back();
        }

    }

    public final function destroy(Form $form)
    {
        try {
            DB::beginTransaction();
            $form->delete();
            FormService::where('form_code', $form->form_code)->delete();
            Storage::delete($form->application_file);
            $response = ResponseHelper::success('Berhasil delete data');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}

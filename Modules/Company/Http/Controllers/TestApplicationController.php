<?php

namespace Modules\Company\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class TestApplicationController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $get['data_user'] = auth()->user()['company'];
        $get['applications'] = Form::where('company_id', $get['data_user']['company_id'])->latest()->get();
        return view('company::test.application', $get);

    }

    public function detail(Form $form)
    {
        return view('company::test.detail', compact('form'));
    }

    public final function updatePosting(Request $request, Form $form)
    {
        try {
            $status = $form->update(['form_status' => 1]);
            $response = ResponseHelper::statusAction('Update posting status', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);


    }
}

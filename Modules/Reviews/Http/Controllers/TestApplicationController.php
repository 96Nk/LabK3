<?php

namespace Modules\Reviews\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\RefEmployee;
use App\Models\ReviewOfficerTemp;
use Illuminate\Http\Request;
use Modules\Reviews\Http\Services\ReviewService;


class TestApplicationController extends Controller
{

    public function index()
    {
        $applications = Form::formStatus()->with(['review'])->latest()->get();
        return view('reviews::reviews.index', compact('applications'));
    }

    public function form_verification(Form $form)
    {
        $employees = RefEmployee::all();
        $officers = ReviewOfficerTemp::where('form_code', $form->form_code)->get();
        return view('reviews::reviews.form_verification', compact('form', 'employees', 'officers'));
    }

    public function storeOfficerTemp(Request $request, ReviewService $reviewService)
    {
        try {
            $reviewService->addReviewOfficerTemp($request);
            $data = $reviewService->getReviewOfficeTemp($request->post('form_code'));
            $response = ResponseHelper::success(data: $data->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    public function deleteOfficerTemp(Request $request, ReviewOfficerTemp $temp, ReviewService $reviewService)
    {
        try {
            $temp->delete();
            $data = $reviewService->getReviewOfficeTemp($temp->form_code);
            $response = ResponseHelper::success(data: $data->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}

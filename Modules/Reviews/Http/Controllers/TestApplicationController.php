<?php

namespace Modules\Reviews\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormAdditional;
use App\Models\RefEmployee;
use App\Models\ReviewOfficerTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Reviews\Http\Services\ReviewService;


class TestApplicationController extends Controller
{

    public function index()
    {
        $applications = Form::where(['review_status' => '0'])->formStatus()->latest()->get();
        return view('reviews::reviews.index', compact('applications'));
    }

    public function formVerification(Form $form)
    {
        $employees = RefEmployee::all();
        $officers = ReviewOfficerTemp::where('form_code', $form->form_code)->get();
        $additionals = FormAdditional::where('form_code', $form->form_code)->get();
        return view('reviews::reviews.form_verification', compact('form', 'employees', 'officers', 'additionals'));
    }

    public final function reviewForm(Request $request, Form $form, ReviewService $reviewService)
    {
        try {
            $reviewService->reviewFormUpdate($request, $form);
            $response = ResponseHelper::success();
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return to_route('reviews.test-application');
    }

    public final function reviewCancel(Request $request, ReviewService $reviewService)
    {
        try {
            $reviewService->reviewFormStatus($request);
            $response = ResponseHelper::success();
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return to_route('reviews.test-application');
    }


    public function posting(Request $request, ReviewService $reviewService)
    {
        try {
            DB::beginTransaction();
            $reviewService->addReviewOfficersAll($request);
            $reviewService->reviewFormStatus($request);
            $this->setFlash('Berhasil Posting', true);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->setFlash($exception->getMessage());
        }
        return back();
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

    public function storeCostTemp(Request $request, ReviewService $reviewService)
    {
        try {
            $reviewService->addCostTemp($request);
            $response = ResponseHelper::success();
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public function updateCostTemp(Request $request, FormAdditional $additional, ReviewService $reviewService)
    {
        try {
//            echo json_encode($additional);
//            die();
            $reviewService->updateCostTemp($request, $additional);
            $response = ResponseHelper::success();
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public function deleteCostTemp(Request $request, FormAdditional $additional)
    {
        try {
            $additional->delete();
            $response = ResponseHelper::success();
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}

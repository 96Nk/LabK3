<?php

namespace Modules\Reviews\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\RefEmployee;
use App\Models\ReviewOfficer;
use Illuminate\Http\Request;
use Modules\Reviews\Http\Services\ReviewService;

class VerificationController extends Controller
{

    public function index()
    {
        $applications = Form::where([
            'verification_status' => 0
        ])->reviewStatus()->latest()->get();
        return view('reviews::verification.index', compact('applications'));
    }

    public function formVerification(Form $form)
    {
        $employees = RefEmployee::all();
        $officers = ReviewOfficer::where('form_code', $form->form_code)->get();
        return view('reviews::verification.form_verification', compact('form', 'employees', 'officers'));
    }

    public function verificationForm(Request $request, ReviewService $reviewService)
    {
        try {
            $status = $reviewService->verificationFormStatus($request);
            $this->setFlash('Verifikasi Data', $status);
            return to_route('reviews.verification');
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
            return back();
        }

    }

    public final function storeOfficer(Request $request, ReviewService $reviewService)
    {
        try {
            $status = $reviewService->addReviewOfficers($request);
            $response = ResponseHelper::statusAction('Menambahkan Pegawai', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    public function deleteOfficer(Request $request, ReviewOfficer $officer, ReviewService $reviewService)
    {
        try {
            $officer->delete();
            $data = $reviewService->getReviewOffice($officer->form_code);
            $response = ResponseHelper::success(data: $data->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}

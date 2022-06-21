<?php

namespace Modules\Signer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LetterAgreement;
use App\Models\UtiRegulation;
use App\Models\UtiUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Signer\Http\Services\AgreementService;
use Modules\Signer\Http\Services\AssignmentService;


class AgreementController extends Controller
{

    public function index()
    {
        $agreements = LetterAgreement::with('form')
            ->agreementStatus()
            ->where(['agreement_signer' => 0])->get();
        return view('signer::agreement.index', compact('agreements'));
    }

    public function verification(LetterAgreement $agreement)
    {
        $regulation = UtiRegulation::first();
        $unit = UtiUnit::first();
        return view('signer::agreement.verification', compact('agreement', 'regulation', 'unit'));
    }

    public final function signerAgreement(Request $request, AgreementService $agreementService)
    {
        try {
            $agreementService->signerAgreement($request);
            $this->setFlash('Signer Agreement Success', true);
            return to_route('signer-agreement');
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
            return back();
        }
    }

    public function correctAgreement(Request $request, AgreementService $agreementService)
    {
        try {
            DB::beginTransaction();
            $agreementService->correctAgreement($request);
            $agreementService->correctInputAgreement($request);
            DB::commit();
            $this->setFlash('Correct Agreement Success', true);
            return to_route('signer-agreement');
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->setFlash($exception->getMessage());
            return back();
        }
    }

}

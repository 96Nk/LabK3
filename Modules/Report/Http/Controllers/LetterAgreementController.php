<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\LetterAgreement;
use App\Models\UtiLetterSigner;
use Illuminate\Http\Request;
use Modules\Report\Http\Services\AgreementService;
use Mpdf\Mpdf;

class LetterAgreementController extends Controller
{

    private Mpdf $MPDF;
    private const CONSTRUCT_PDF = [
        'mode' => 'utf-8',
        'format' => 'Legal-P',
        'default_font_size' => 1,
        'default_font' => 'Tahoma',
        'margin_left' => 8,
        'margin_right' => 8,
        'margin_top' => 8,
        'margin_bottom' => 35,
        'margin_header' => 8,
        'margin_footer' => 35
    ];

    public function __construct()
    {
        $this->MPDF = new Mpdf(static::CONSTRUCT_PDF);
    }

    public function index()
    {
        $applications = Form::with(['letter_assignment', 'company'])
            ->reviewStatus()
            ->formStatus()
            ->verificationStatus()
            ->latest()->get();
        return view('report::letter_agreement.index', compact('applications'));
    }

    public function inputAgreement(Form $form)
    {
        $number = LetterAgreement::where('agreement_year', date('Y'))->max('agreement_number');
        $data['maxNumber'] = $number ? $number + 1 : 1;
        $data['signers'] = UtiLetterSigner::all();
        $data['form'] = $form;
        return view('report::letter_agreement.input', $data);
    }

    public function printPdf(Form $form)
    {
        $data = [
            'printQrCode' => 'Test PDF',
            'form' => $form,
        ];
        $html = view('report::letter_assignment.print_pdf', $data);
        $this->MPDF->WriteHTML($html);
        header('Content-Type', 'application/pdf');
        $this->MPDF->Output('Test', 'I');
    }

    public final function store(Request $request, AgreementService $agreementService)
    {
        try {
            $agreementService->addLetterAgreement($request);
            $this->setFlash('Input data SPK', true);
            return to_route('letter-agreement');
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
            return back();
        }
    }

    public final function posting(Request $request, AgreementService $agreementService)
    {
        try {
            $agreementService->postingLetterAgreement($request);
            $this->setFlash('Posting data SPK', true);
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
        }
        return back();
    }

}

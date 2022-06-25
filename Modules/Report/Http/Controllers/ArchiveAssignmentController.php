<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Form;
use App\Models\LetterAssignment;
use App\Models\ReviewOfficer;
use App\Models\UtiLetterSigner;
use Illuminate\Http\Request;
use Modules\Report\Http\Services\AssignmentService;
use Mpdf\Mpdf;

class ArchiveAssignmentController extends Controller
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
        $assignments = LetterAssignment::with(['form'])->AssignmentStatus()->latest()->get();
        return view('report::archive_assignment.index', compact('assignments'));
    }

    /**
     * @throws \Mpdf\MpdfException
     */
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


    public function inputAssignment(Form $form)
    {
        $number = LetterAssignment::where('assignment_year', date('Y'))->max('assignment_number');
        $data['maxNumber'] = $number ? $number + 1 : 1;
        $data['company'] = Company::find($form->company_id);
        $data['officers'] = ReviewOfficer::where('form_code', $form->form_code)->get();
        $data['signers'] = UtiLetterSigner::all();
        $data['form'] = $form;
        return view('report::letter_assignment.input', $data);
    }

    public final function store(Request $request, AssignmentService $reportService)
    {
        try {
            $reportService->addLetterAssignment($request);
            $this->setFlash('Input data SPT', true);
            return to_route('letter-assignment');
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
            return back();
        }
    }

    public final function posting(Request $request, AssignmentService $assignmentService)
    {
        try {
            $assignmentService->postingLetterAssignment($request);
            $this->setFlash('Posting data SPT', true);
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
        }
        return back();
    }


}

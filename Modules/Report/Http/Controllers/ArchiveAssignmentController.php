<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Form;
use App\Models\LetterAssignment;
use App\Models\ReviewOfficer;
use App\Models\UtiLetterSigner;
use App\Models\UtiUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Report\Http\Services\AssignmentService;
use Mpdf\Mpdf;

class ArchiveAssignmentController extends Controller
{

    private Mpdf $MPDF;
    private const CONSTRUCT_PDF = [
        'mode' => 'utf-8',
        'format' => 'A4-P',
        'default_font_size' => 1,
        'default_font' => 'Tahoma',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 8,
        'margin_bottom' => 8,
        'margin_header' => 8,
        'margin_footer' => 8
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
    public function printPdf(LetterAssignment $assignment)
    {
        $data = [
            'printQrCode' => $this->printQrCode(url()->current()),
            'assignment' => $assignment,
            'officers' => ReviewOfficer::where('form_code', $assignment->form_code)
                ->select('review_officers.*', 'ref_positions.position_status')
                ->join('ref_employees', 'ref_employees.nip_nik', '=', 'review_officers.nip_nik')
                ->join('ref_positions', 'ref_positions.position_id', '=', 'ref_employees.position_id')
                ->orderBy(DB::raw('ref_positions.position_status, ref_positions.position_id'))->get(),
            'unit' => UtiUnit::first()
        ];
        $html = view('report::archive_assignment.print_pdf', $data);
        $this->MPDF->SetHTMLFooter('<table width="100%" border="0" style="font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
    <tr>
        <td><img src="assets/images/logo-kan.png" width="15%" hidden="10%"></td>
        <td>' . isoIecNumber() . ' </td >
        <td width="50%"></td >
    </tr>
</table>');
        $this->MPDF->WriteHTML($html);
//        header('Content-Type', 'application/pdf');
        $this->MPDF->Output($assignment->form_code . '.pdf', 'I');
        $this->MPDF->debug = true;
    }


    public function inputAssignment(Form $form)
    {
        $number = LetterAssignment::where('assignment_year', date('Y'))->max('assignment_number');
        $data['maxNumber'] = $number ? $number + 1 : 1;
        $data['company'] = Company::find($form->company_id);
        $data['officers'] = ReviewOfficer::where('form_code', $form->form_code)->get();
        $data['signers'] = UtiLetterSigner::all();
        $data['form'] = $form;
        return view('report::letter_assignment . input', $data);
    }

    public final function store(Request $request, AssignmentService $reportService)
    {
        try {
            $reportService->addLetterAssignment($request);
            $this->setFlash('Input data SPT', true);
            return to_route('letter - assignment');
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

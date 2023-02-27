<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Form;
use App\Models\LetterAgreement;
use App\Models\LetterAssignment;
use App\Models\ReviewOfficer;
use App\Models\UtiAccount;
use App\Models\UtiLetterSigner;
use App\Models\UtiRegulation;
use App\Models\UtiUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Report\Http\Services\AssignmentService;
use Mpdf\Mpdf;

class ArchiveAgreementController extends Controller
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
        'margin_bottom' => 20,
        'margin_header' => 8,
        'margin_footer' => 8
    ];


    public function __construct()
    {
        $this->MPDF = new Mpdf(static::CONSTRUCT_PDF);
    }

    public function index()
    {
        $agreements = LetterAgreement::with(['form'])
            ->agreementStatus()
            ->agreementSigner()
            ->latest()->get();
        return view('report::archive_agreement.index', compact('agreements'));
    }

    /**
     * @throws \Mpdf\MpdfException
     */
    public function printPdf(LetterAgreement $agreement)
    {

        $data = [
            'agreement' => $agreement,
            'unit' => UtiUnit::first(),
            'regulation' => UtiRegulation::first(),
            'account' => UtiAccount::first()
        ];
        $html = view('report::archive_agreement.print_pdf', $data);
        $qrCode = $agreement->agreement_signer == 1 ? '<img src="' . $this->printQrCode(url()->current()) . '" width="50px" height="50px">' : '';
        $qrCode = '';
        $this->MPDF->SetHTMLFooter('<table width="100%" border="0" style="font-family: serif; font-size: 8pt; color: #000000;">
    <tr>
        <td width="10%">' . $qrCode . '</td>
        <td>DL 7.1.3.1</td>
        <td width="20%" style="text-align: right;border-left: 0px ; ">Halaman {PAGENO} Dari {nbpg}</td>
    </tr>
</table>');
        $this->MPDF->WriteHTML($html);
//        header('Content-Type', 'application/pdf');
        $this->MPDF->Output($agreement->form_code . '.pdf', 'I');
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

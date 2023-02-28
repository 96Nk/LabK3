<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Form;
use App\Models\LetterAssignment;
use App\Models\LetterReceipt;
use App\Models\ReviewOfficer;
use App\Models\UtiLetterSigner;
use App\Models\UtiUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Report\Http\Services\AssignmentService;
use Mpdf\Mpdf;

class ArchiveReceiptController extends Controller
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
        $receipts = LetterReceipt::with(['form'])->ReceiptStatus()->latest()->get();
        return view('report::archive_receipt.index', compact('receipts'));
    }

    public function printPdf(LetterReceipt $receipt)
    {
        $data = [
            'printQrCode' => $this->printQrCode(url()->current()),
            'receipt' => $receipt,
            'form' => Form::where('form_code', $receipt->form_code)->first(),
        ];

        $html = view('report::archive_receipt.print_pdf', $data);
        $this->MPDF->SetHTMLFooter('<table width="100%" border="0" style="font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
    <tr>
        <td><img src="assets/images/logo-kan.png" width="15%" hidden="10%"></td>
        <td>' . isoIecNumber() . ' </td >
        <td width="50%"></td >
    </tr>
</table>');
        $this->MPDF->WriteHTML($html);
//        header('Content-Type', 'application/pdf');
        $this->MPDF->Output($receipt->form_code . '.pdf', 'I');
        $this->MPDF->debug = true;
    }

}

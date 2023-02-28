<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\LetterReceipt;
use App\Models\RefAccount;
use App\Models\UtiLetterSigner;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Report\Http\Services\ReceiptService;

class LetterReceiptController extends Controller
{

    public function __construct(
        private ReceiptService $receiptService
    )
    {
    }

    public function index()
    {
        $applications = Form::with(['letter_receipt', 'company'])
            ->reviewStatus()
            ->formStatus()
            ->verificationStatus()
            ->latest()->get();
//        echo json_encode($applications);
//        die();
        return view('report::letter_receipt.index', compact('applications'));
    }


    public function create(Form $form)
    {
        $number = LetterReceipt::where('receipt_year', date('Y'))->max('receipt_number');
        $data['maxNumber'] = $number ? $number + 1 : 1;
        $data['signers'] = UtiLetterSigner::all();
        $data['accounts'] = RefAccount::all();
        $data['form'] = $form->with(['letter_receipt', 'company'])->first();
        $data['total'] = $form->sum_service + $form->sum_additional;
        return view('report::letter_receipt.input', $data);
    }

    public function store(Request $request)
    {
        try {
            $this->receiptService->addLetterReceipt($request);
            $this->setFlash('Input data kuitansi', true);
            return to_route('letter-receipt');
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
            return back();
        }
    }

    public final function posting(Request $request)
    {
        try {
            $this->receiptService->postingLetterReceipt($request);
            $this->setFlash('Posting data Kuitansi', true);
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
        }
        return back();
    }
}

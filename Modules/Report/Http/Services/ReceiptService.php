<?php

namespace Modules\Report\Http\Services;

use App\Models\Company;
use App\Models\LetterAssignment;
use App\Models\LetterReceipt;
use App\Models\UtiLetterSigner;
use Illuminate\Http\Request;

class ReceiptService
{

    public function __construct()
    {
    }


    public final function addLetterReceipt(Request $request): \Illuminate\Database\Eloquent\Model|LetterAssignment
    {
        $attributes = $request->validate([
            'form_code' => 'required',
            'receipt_number' => 'required',
            'receipt_desc' => 'required',
            'receipt_address' => 'required',
            'account_code' => 'required',
            'signer_company_name' => 'required',
            'signer_company_position' => 'required',
            'signer_employee_nip' => 'required',

        ]);
        $signer = UtiLetterSigner::where('nip', $request->post('signer_employee_nip'))->first();
        $addition = [
            'receipt_year' => date('Y'),
            'signer_employee_name' => $signer->signer_name,
            'signer_employee_position' => $signer->signer_position,
        ];
        $data = array_merge($attributes, $addition);
        return LetterReceipt::updateOrCreate(['form_code' => $attributes['form_code']], $data);
    }

    public final function postingLetterReceipt(Request $request): bool
    {
        $id = $request->post('receipt_id');
        $data = ['receipt_status' => 1];
        return LetterReceipt::where('receipt_id', $id)->update($data);
    }


}

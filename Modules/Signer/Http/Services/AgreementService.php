<?php

namespace Modules\Report\Http\Services;

use App\Models\Company;
use App\Models\Form;
use App\Models\LetterAgreement;
use App\Models\LetterAssignment;
use App\Models\UtiAccount;
use App\Models\UtiLetterSigner;
use App\Models\UtiRegulation;
use Illuminate\Http\Request;

class AgreementService
{

    public function __construct()
    {
    }


    public final function addLetterAgreement(Request $request)
    {
        $attributes = $request->validate([
            'form_code' => 'required',
            'agreement_number' => 'required',
            'agreement_date' => 'required',
            'agreement_date_start' => 'required',
            'agreement_date_end' => 'required',
            'signer_employee_nip' => 'required',
        ]);
        $signer = UtiLetterSigner::where('nip', $request->post('signer_employee_nip'))->first();
        $regulation = UtiRegulation::first();
        $account = UtiAccount::first();
        $form = Form::with('company')->where(['form_code' => $request->form_code])->first();
        $addition = [
            'agreement_year' => date('Y'),
            'signer_employee_name' => $signer->signer_name,
            'signer_employee_position' => $signer->signer_position,
            'signer_company_name' => $form->company->signer_name,
            'signer_company_position' => $form->company->signer_position,
            'agreement_account' => $account->account_number . ' an. ' . $account->account_name,
            'agreement_regulation' => sprintfNumber($regulation->regulation_number, 2) . ' Tahun ' . $regulation->regulation_year,
        ];
        $data = array_merge($attributes, $addition);
        return LetterAgreement::updateOrCreate(['form_code' => $attributes['form_code']], $data);
    }

    public final function postingLetterAgreement(Request $request): bool
    {
        $id = $request->post('agreement_id');
        $data = ['agreement_status' => 1];
        return LetterAgreement::where('agreement_id', $id)->update($data);
    }


}

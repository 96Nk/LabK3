<?php

namespace Modules\Signer\Http\Services;

use App\Models\LetterAgreement;
use App\Models\LetterAgreementCorrect;
use Illuminate\Http\Request;

class AgreementService
{

    public function __construct()
    {
    }

    public final function signerAgreement(Request $request): bool
    {
        $id = $request->post('agreement_id');
        $data = ['agreement_signer' => 1];
        return LetterAgreement::where('agreement_id', $id)->update($data);
    }

    public final function correctAgreement(Request $request): bool
    {
        $id = $request->post('agreement_id');
        $data = ['agreement_signer' => 0, 'agreement_status' => 0];
        return LetterAgreement::where('agreement_id', $id)->update($data);
    }

    public final function correctInputAgreement(Request $request)
    {
        $attributes = $request->validate([
            'agreement_id' => 'required',
            'agreement_correct_description' => 'required',
        ]);
        return LetterAgreementCorrect::create($attributes);
    }

}

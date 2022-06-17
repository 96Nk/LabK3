<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Form;

class LetterAgreementController extends Controller
{
    public function index()
    {
        $applications = Form::with(['letter_agreement', 'company'])
            ->reviewStatus()
            ->formStatus()
            ->verificationStatus()
            ->latest()->get();
        return view('report::letter_agreement.index', compact('applications'));
    }

}

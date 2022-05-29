<?php

namespace Modules\Reviews\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Form;

class VerificationController extends Controller
{

    public function index()
    {
        $applications = Form::where(['verification_status' => 0])
            ->reviewStatus()->latest()->get();
        return view('reviews::verification.index', compact('applications'));
    }
}

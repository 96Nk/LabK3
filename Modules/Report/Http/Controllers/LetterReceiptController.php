<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\LetterReceipt;
use App\Models\UtiLetterSigner;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class LetterReceiptController extends Controller
{

    public function index()
    {
        $applications = Form::with(['letter_receipt', 'company'])
            ->reviewStatus()
            ->formStatus()
            ->verificationStatus()
            ->latest()->get();
        echo json_encode($applications);
        die();
        return view('report::letter_receipt.index', compact('applications'));
    }


    public function create(Form $form)
    {
        $number = LetterReceipt::where('receipt_year', date('Y'))->max('receipt_number');
        $data['maxNumber'] = $number ? $number + 1 : 1;
        $data['signers'] = UtiLetterSigner::all();
        $data['form'] = $form->with(['letter_receipt', 'company'])->first();
        $data['total'] = $form->sum_service + $form->sum_additional;
        return view('report::letter_receipt.input', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('report::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('report::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

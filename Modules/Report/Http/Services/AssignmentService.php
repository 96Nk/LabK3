<?php

namespace Modules\Report\Http\Services;

use App\Models\Company;
use App\Models\LetterAssignment;
use App\Models\UtiLetterSigner;
use Illuminate\Http\Request;

class AssignmentService
{

    public function __construct()
    {
    }


    public final function addLetterAssignment(Request $request): \Illuminate\Database\Eloquent\Model|LetterAssignment
    {
        $attributes = $request->validate([
            'form_code' => 'required',
            'assignment_number' => 'required',
            'assignment_date' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'assignment_about' => 'required',
            'signer_employee_nip' => 'required',
            'assignment_charge' => 'required',
        ]);
        $signer = UtiLetterSigner::where('nip', $request->post('signer_employee_nip'))->first();
        $addition = [
            'assignment_year' => date('Y'),
            'signer_employee_name' => $signer->signer_name,
            'signer_employee_position' => $signer->signer_position,
        ];
        $data = array_merge($attributes, $addition);
        return LetterAssignment::updateOrCreate(['form_code' => $attributes['form_code']], $data);
    }

    public final function postingLetterAssignment(Request $request): bool
    {
        $id = $request->post('assignment_id');
        $data = ['assignment_status' => 1];
        return LetterAssignment::where('assignment_id', $id)->update($data);
    }


}

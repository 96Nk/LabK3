<?php

namespace Modules\Signer\Http\Services;

use App\Models\Company;
use App\Models\LetterAssignment;
use App\Models\LetterAssignmentCorrect;
use App\Models\UtiLetterSigner;
use Illuminate\Http\Request;

class AssignmentService
{

    public function __construct()
    {
    }

    public final function signerAssignment(Request $request): bool
    {
        $id = $request->post('assignment_id');
        $data = ['assignment_signer' => 1];
        return LetterAssignment::where('assignment_id', $id)->update($data);
    }

    public final function correctAssignment(Request $request): bool
    {
        $id = $request->post('assignment_id');
        $data = ['assignment_signer' => 0, 'assignment_status' => 0];
        return LetterAssignment::where('assignment_id', $id)->update($data);
    }

    public final function correctInputAssgment(Request $request)
    {
        $attributes = $request->validate([
            'assignment_id' => 'required',
            'assignment_correct_description' => 'required',
        ]);
        return LetterAssignmentCorrect::create($attributes);
    }


}

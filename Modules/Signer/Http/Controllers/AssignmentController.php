<?php

namespace Modules\Signer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LetterAssignment;
use App\Models\ReviewOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Signer\Http\Services\AssignmentService;

class AssignmentController extends Controller
{

    public function index()
    {
        $assignments = LetterAssignment::with('form')
            ->assignmentStatus()->latest()->get();
        return view('signer::assignment.index', compact('assignments'));
    }

    public function verification(LetterAssignment $assignment)
    {
        $officers = ReviewOfficer::where('form_code', $assignment->form_code)->get();
        return view('signer::assignment.verification', compact('assignment', 'officers'));
    }

    public function signerAssignment(Request $request, AssignmentService $assignmentService)
    {
        try {
            $assignmentService->signerAssignment($request);
            $this->setFlash('Signer Assignment Success', true);
            return to_route('signer-assignment');
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
            return back();
        }
    }

    public function correctAssignment(Request $request, AssignmentService $assignmentService)
    {
        try {
            DB::beginTransaction();
            $assignmentService->correctAssignment($request);
            $assignmentService->correctInputAssgment($request);
            DB::commit();
            $this->setFlash('Correct Assignment Success', true);
            return to_route('signer-assignment');
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->setFlash($exception->getMessage());
            return back();
        }
    }
}

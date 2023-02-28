<?php

namespace Modules\Company\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\TicketComplaint;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Company\Http\Services\ComplaintService;

class ComplaintController extends Controller
{

    public function __construct(private ComplaintService $complaintService)
    {
    }

    public function index()
    {
        $company = auth()->user()['company'];
        $complaints = TicketComplaint::where([
            'company_id' => $company->company_id,
            'complaint_status' => 0,
        ])->latest()->get();
        return view('company::complaint.index', compact('complaints'));
    }

    public function store(Request $request)
    {
        try {
            $this->complaintService->addComplaint($request);
            $response = ResponseHelper::success('Simpan data pengaduan');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public function show(TicketComplaint $complaint)
    {
        $data['complaint'] = $complaint->with('feedbacks')->first();
        return view('company::complaint.show', $data);
    }

    public function posting(TicketComplaint $complaint)
    {
        try {
            $complaint->update(['complaint_posting' => 1]);
            $response = ResponseHelper::success('Posting selesai');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response, $response['statusCode']);
    }


    public function destroy(TicketComplaint $complaint)
    {
        try {
            $complaint->delete();
            $response = ResponseHelper::success('delete data pengaduan');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response, $response['statusCode']);
    }
}

<?php

namespace Modules\Company\Http\Services;

use App\Models\Form;
use App\Models\FormService;
use App\Models\ServiceDetail;
use App\Models\TicketComplaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComplaintService
{
    public function __construct()
    {
    }

    public final function addComplaint(Request $request): \Illuminate\Database\Eloquent\Model|Form
    {
        $company = auth()->user()['company'];
        $request->validate([
            'complaint_title' => 'required',
            'complaint_desc' => 'required',
        ]);

        $data = [
            'complaint_code' => \Str::upper(Str::random(20)),
            'company_id' => $company->company_id,
            'complaint_title' => $request->complaint_title,
            'complaint_desc' => $request->complaint_desc,
        ];
        return TicketComplaint::create($data);
    }


}

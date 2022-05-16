<?php

namespace Modules\Company\Http\Services;

use App\Models\Company;
use App\Models\Form;
use App\Models\FormService;
use App\Models\ServiceDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormDetailService
{

    public function __construct()
    {
    }

    public final function addForm(Request $request): \Illuminate\Database\Eloquent\Model|Form
    {
        $company = auth()->user()['company'];
        $request->validate([
            'signer_name' => 'required',
            'signer_position' => 'required',
            'application_about' => 'required',
            'application_number' => 'required',
            'application_date' => 'required',
            'file' => 'required|mimes:pdf|max:4096',
        ]);

        $data = [
            'form_code' => $request->form_code,
            'company_id' => $company->company_id,
            'signer_name' => $request->signer_name,
            'signer_position' => $request->signer_position,
            'application_about' => $request->application_about,
            'application_number' => $request->application_number,
            'application_date' => $request->application_date,
            'form_date' => Carbon::now()->format('Y-m-d'),
            'application_file' => $request->file('file')->store('application'),

        ];
        return Form::create($data);
    }

    public final function addFormService(Request $request): bool
    {
        $postsFilter = array_filter($request->post('point_sample'));
        $postsKey = array_keys($postsFilter);
        $services = ServiceDetail::whereIn('service_detail_id', $postsKey)->get();
        $data = [];
        foreach ($services as $key => $service) {
            $pointSample = 0;
            foreach ($postsFilter as $i => $point) {
                if ($i == $service->service_detail_id) $pointSample = $point;
            }
            $dd['form_code'] = $request->form_code;
            $dd['service_head_id'] = $service->service_head_id;
            $dd['service_body_id'] = $service->service_body_id;
            $dd['service_detail_id'] = $service->service_detail_id;
            $dd['service_detail_name'] = $service->service_detail_name;
            $dd['service_detail_unit'] = $service->service_detail_unit;
            $dd['service_detail_cost'] = $service->service_detail_cost;
            $dd['point_sample'] = $pointSample;
            $data[] = $dd;
        }
        FormService::where('form_code', $request->form_code)->delete();
        return FormService::insert($data);
    }

    public final function getFormServiceHead(): FormService|\Illuminate\Database\Query\Builder
    {
        return FormService::join('service_head', 'service_head_id', '=', 'service_head_id');
    }
}

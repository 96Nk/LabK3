<?php

namespace Modules\Company\Http\Services;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyService
{

    public function __construct()
    {
    }

    public function getCompanies()
    {

    }

    public final function addCompany(Request $request): \Illuminate\Database\Eloquent\Model|Company
    {
        $attributes = $request->validate([
            'company_name' => 'required',
            'company_email' => 'required|unique:companies|email',
            'company_phone' => 'required',
            'company_address' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'prov_id' => 'required',
            'village_id' => 'required',
        ]);
        return Company::create($attributes);
    }

    public final function updateCompany(Request $request, int $id): bool|int
    {
        $request->validate([
            'company_name' => 'required',
            'company_phone' => 'required',
            'company_address' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'prov_id' => 'required',
            'village_id' => 'required',
            'company_description' => 'required',
            'company_npwp' => 'required',
            'image' => 'image|file|max:2048',
            'signer_name' => 'required',
            'signer_position' => 'required',
        ]);

        $data = [
            'company_name' => $request->company_name,
            'company_phone' => $request->company_phone,
            'company_address' => $request->company_address,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'prov_id' => $request->prov_id,
            'village_id' => $request->village_id,
            'company_description' => $request->company_description,
            'company_npwp' => $request->company_npwp,
            'signer_name' => $request->signer_name,
            'signer_position' => $request->signer_position,
        ];

        if ($request->file('image')) {
            $data['logo_file'] = $request->file('image')->store('company');
        }

        return Company::where('company_id', $id)->update($data);
    }

}

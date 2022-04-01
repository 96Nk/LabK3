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
            'company_name' => ['required'],
            'company_email' => ['required', 'unique:companies', 'email'],
            'company_phone' => ['required'],
            'company_address' => ['required'],
            'city_id' => ['required'],
            'district_id' => ['required'],
            'prov_id' => ['required'],
            'village_id' => ['required'],
        ]);
        return Company::create($attributes);
    }

}

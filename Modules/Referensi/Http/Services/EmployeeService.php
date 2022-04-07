<?php

namespace Modules\Referensi\Http\Services;

use App\Models\RefEmployee;
use Illuminate\Http\Request;

class EmployeeService
{

    public final function getEmployee()
    {

    }

    public final function addEmployee(Request $request): \Illuminate\Database\Eloquent\Model|RefEmployee
    {
        return RefEmployee::create($request->all());
    }

    public final function updateEmployee(Request $request): bool|int
    {
        $data = [
            'position_id' => $request->position_id,
            'employee_name' => $request->employee_name,
            'nip_nik' => $request->nip_nik
        ];
        return RefEmployee::where('employee_id', $request->employee_id)
            ->update($data);
    }
}

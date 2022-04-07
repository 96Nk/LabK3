<?php

namespace Modules\Referensi\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\RefEmployee;
use App\Models\RefPosition;
use Modules\Referensi\Http\Requests\EmployeeRequest;
use Modules\Referensi\Http\Services\EmployeeService;

class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeService $employeeService
    )
    {
    }

    public function index()
    {
        $get = [
            'employees' => RefEmployee::all(),
            'positions' => RefPosition::all()
        ];
        return view('referensi::employee.index', $get);
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $id = $request->post('employee_id');
            $status = $id ?
                $this->employeeService->updateEmployee($request) :
                (bool)$this->employeeService->addEmployee($request);
            $response = ResponseHelper::statusAction($id ? 'Update data Employee ' : 'Input data Employee', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public function destroy(RefEmployee $refEmployee)
    {
        try {
            $status = $refEmployee->delete();
            $response = ResponseHelper::statusAction('Delete data Employee', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        return response()->json($response);
    }
}

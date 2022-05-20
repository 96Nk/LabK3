<?php

namespace Modules\Reviews\Http\Services;

use App\Models\Company;
use App\Models\ReviewOfficerTemp;
use Illuminate\Http\Request;

class ReviewService
{

    public function __construct()
    {
    }

    public final function getReviewOfficeTemp(string $form_code = ''): \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array
    {
        return $form_code
            ? ReviewOfficerTemp::where('form_code', $form_code)->get()
            : ReviewOfficerTemp::all();
    }

    /**
     * @throws \Exception
     */
    public final function addReviewOfficerTemp(Request $request): bool
    {
        $attributes = $request->validate([
            'form_code' => 'required',
            'nip_nik' => 'required',
            'employee_name' => 'required',
            'position' => 'required',
        ]);
        $status = ReviewOfficerTemp::insert($attributes);
        if ($status === false) throw new \Exception('Gagal Input Data.');
        return $status;
    }


}

<?php

namespace Modules\Reviews\Http\Services;

use App\Models\Company;
use App\Models\Form;
use App\Models\ReviewOfficer;
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

    /**
     * @throws \Exception
     */
    public final function reviewFormUpdate(Request $request, Form $form): bool
    {
        $attributes = $request->validate([
            'test_date_review' => 'required'
        ]);
        $status = $form->update($attributes);
        if ($status === false) throw new \Exception('Gagal Verifikasi Data.');
        return $status;
    }

    public final function addReviewOfficers(Request $request)
    {
        $officersTemp = $this->getReviewOfficeTemp($request->form_code);
        $data = [];
        foreach ($officersTemp as $officer) {
            $dd['form_code'] = $request->form_code;
            $dd['nip_nik'] = $officer['nip_nik'];
            $dd['employee_name'] = $officer['employee_name'];
            $dd['position'] = $officer['position'];
            $data[] = $dd;
        }
//        ReviewOfficerTemp::where('form_code', $request->form_code)->delete();
        return ReviewOfficer::insert($data);
    }


}

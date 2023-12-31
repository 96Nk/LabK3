<?php

namespace Modules\Reviews\Http\Services;

use App\Models\Company;
use App\Models\Form;
use App\Models\FormAdditional;
use App\Models\ReviewOfficer;
use App\Models\ReviewOfficerTemp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\Runner\Exception;

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

    public final function getReviewOffice(string $form_code = ''): \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array
    {
        return $form_code
            ? ReviewOfficer::where('form_code', $form_code)->get()
            : ReviewOfficer::all();
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


    public final function addCostTemp(Request $request): bool
    {
        $attributes = $request->validate([
            'form_code' => 'required',
            'form_additional_desc' => 'required',
            'form_additional_cost' => 'required',
        ]);
        $status = FormAdditional::insert($attributes);
        if ($status === false) throw new \Exception('Gagal Input Data.');
        return $status;
    }

    public final function updateCostTemp(Request $request, FormAdditional $additional): bool
    {
        $attributes = $request->validate([
            'form_code' => 'required',
            'form_additional_desc' => 'required',
            'form_additional_cost' => 'required',
        ]);
        $status = $additional->update($attributes);
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

    /**
     * @throws \Exception
     */
    public final function reviewFormStatus(Request $request): bool
    {
        $data = [
            'review_status' => $request->post('action') == 'false' ? 2 : 1,
            'review_date' => Carbon::now(),
        ];
        if ($request->post('action') == 'false')
            $data['desc_cancelled'] = $request->post('desc_cancelled');

        $status = Form::where('form_code', $request->post('form_code'))->update($data);
        if ($status === false) throw new \Exception('Gagal Posting Data.');
        return $status;
    }

    /**
     * @throws \Exception
     */
    public final function addReviewOfficersAll(Request $request): bool
    {
        $officersTemp = $this->getReviewOfficeTemp($request->form_code);
        if ($officersTemp->isEmpty()) {
            throw new \Exception("officer can't be empty");
        } else {
            $data = [];
            foreach ($officersTemp as $officer) {
                $dd['form_code'] = $request->form_code;
                $dd['nip_nik'] = $officer['nip_nik'];
                $dd['employee_name'] = $officer['employee_name'];
                $dd['position'] = $officer['position'];
                $data[] = $dd;
            }
            ReviewOfficerTemp::where('form_code', $request->form_code)->delete();
            return ReviewOfficer::insert($data);
        }

    }

    /**
     * @throws \Exception
     */
    public final function addReviewOfficers(Request $request): bool
    {

        $attributes = $request->validate([
            'form_code' => 'required',
            'nip_nik' => 'required',
            'employee_name' => 'required',
            'position' => 'required',
        ]);
        $status = ReviewOfficer::insert($attributes);
        if ($status === false) throw new \Exception('Gagal Input Data.');
        return $status;

    }

    /**
     * @throws \Exception
     */
    public final function verificationFormStatus(Request $request): bool
    {
        $data = [
            'verification_status' => $request->post('action') == 'false' ? 2 : 1,
            'verification_date' => Carbon::now(),
        ];
        if ($request->post('action') == 'false') {
            $data['desc_cancelled'] = $request->post('desc_cancelled');
        }
        $status = Form::where('form_code', $request->post('form_code'))->update($data);
        if ($status === false) throw new \Exception('Gagal Verifikasi Data.');
        return $status;
    }


}

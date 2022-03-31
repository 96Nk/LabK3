<?php

namespace Modules\Referensi\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\RefDistrict;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RefDistrictController extends Controller
{

    public function index()
    {
        return view('referensi::index');
    }

    public final function loadDistricts(int $city_id)
    {
        try {
            $data = RefDistrict::where('city_id', $city_id)->get();
            RefDistrict::where('city_code')->get();
            $response = ResponseHelper::success(data: $data->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}

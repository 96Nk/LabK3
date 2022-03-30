<?php

namespace Modules\Referensi\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\RefCity;
use Illuminate\Routing\Controller;

class RefCityController extends Controller
{

    public function index()
    {
        return view('referensi::index');
    }

    public final function loadCities(int $province_id): \Illuminate\Http\JsonResponse
    {
        try {
            $cities = RefCity::where('prov_id', $province_id)->get();
            $response = ResponseHelper::success(data: $cities->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}

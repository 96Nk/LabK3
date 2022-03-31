<?php

namespace Modules\Referensi\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\RefVillage;
use Illuminate\Routing\Controller;

class RefVillageController extends Controller
{

    public function index()
    {
        return view('referensi::index');
    }

    public final function loadVillage(int $district_id)
    {
        try {
            $data = RefVillage::where('district_id', $district_id)->get();
            $response = ResponseHelper::success(data: $data->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}

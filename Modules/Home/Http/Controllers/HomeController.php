<?php

namespace Modules\Home\Http\Controllers;

use App\Models\RefCity;
use App\Models\RefDistrict;
use App\Models\RefProvince;
use App\Models\RefVillage;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{

    public function __invoke()
    {
        $data['data_user'] = auth()->user();
        if ($data['data_user']->level_id == 2) {
            $data['provinces'] = RefProvince::all();
            $data['cities'] = RefCity::all();
            $data['districts'] = RefDistrict::all();
            $data['villages'] = RefVillage::all();
            return view('home::company', $data);
        } else {
            return view('home::index', $data);
        }
    }

}

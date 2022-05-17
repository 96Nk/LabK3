<?php

namespace Modules\Home\Http\Controllers;

use App\Models\Form;
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
            $data['applications'] = Form::where('company_id', $data['data_user']['company']['company_id'])->latest()->get();
            return view('home::company', $data);
        } elseif ($data['data_user']->level_id == 4) {
            return view('home::manager_teknis', $data);
        } else {
            return view('home::index', $data);
        }
    }

}

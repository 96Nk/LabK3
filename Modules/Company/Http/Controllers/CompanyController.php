<?php

namespace Modules\Company\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        $get['companies'] = Company::get();
        return view('company::index', $get);
    }
}

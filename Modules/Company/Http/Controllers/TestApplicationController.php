<?php

namespace Modules\Company\Http\Controllers;

use App\Models\Form;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestApplicationController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $get['data_user'] = auth()->user()['company'];
        $get['applications'] = Form::where('company_id', $get['data_user']['company_id'])->get();
        return view('company::test.application', $get);

    }
}

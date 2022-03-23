<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\UserLevel;

class HomeController extends Controller
{

    public function __invoke()
    {
        return view('home::index');
    }

}

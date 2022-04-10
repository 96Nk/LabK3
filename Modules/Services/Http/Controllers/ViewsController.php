<?php

namespace Modules\Services\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ViewsController extends Controller
{

    public function __invoke()
    {
        return view('services::index');
    }
}

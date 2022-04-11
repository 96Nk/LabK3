<?php

namespace Modules\Services\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceHead;

class ViewsController extends Controller
{

    public function __invoke()
    {
        $get = [
            'services' => ServiceHead::all()
        ];
        return view('services::index', $get);
    }
}

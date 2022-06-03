<?php

namespace Modules\Reviews\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Form;
use PhpParser\Node\Stmt\Echo_;

class ArchiveController extends Controller
{

    public function index()
    {
        $applications = Form::latest()->get();
        return view('reviews::archive.index', compact('applications'));
    }

}

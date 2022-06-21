<?php

namespace Modules\Utility\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\UtiLetterSigner;
use App\Models\UtiRegulation;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Utility\Http\Requests\SignerRequest;
use Modules\Utility\Http\Services\SignerService;

class RegulationController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $regulation = UtiRegulation::first();
        return view('utility::regulation.index', compact('regulation'));
    }

    public function update(Request $request)
    {
        try {
            $attributes = $request->validate([
                'regulation_number' => 'required',
                'regulation_about' => 'required',
                'regulation_year' => 'required',
            ]);
            UtiRegulation::where(['regulation_id' => $request->post('regulation_id')])->update($attributes);
            $this->setFlash('Update Regulation', true);
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
        }
        return back();
    }
}

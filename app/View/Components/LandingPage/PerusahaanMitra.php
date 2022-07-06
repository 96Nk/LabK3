<?php

namespace App\View\Components\LandingPage;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class PerusahaanMitra extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $segment = \request()->segment(1);
        if(isset($segment)){
            $partners = Company::limit(15)->get();
        } else {
            $partners = Company::all();
        }
        return view('components.landing-page.perusahaan_mitra', compact('partners'));
    }
}
